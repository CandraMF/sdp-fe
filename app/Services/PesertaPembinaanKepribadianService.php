<?php

namespace App\Services;

use App\Models\Identitas;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;


class PesertaPembinaanKepribadianService
{

	public function __construct()
	{
	}

	/**
	 * Make http client
	 *
	 * @param string $baseURI
	 * @param bool $httpErrors
	 * @param string $token
	 */
	private function makeApi(string $baseURI, ?bool $httpErrors = true, ?string $token = NULL)
	{
		$data = [
			'base_uri' => $baseURI,
			'headers'  => ['Accept' => 'application/json'],
			'http_errors' => $httpErrors,
		];

		if (!is_null($token)) {
			$data['headers']['Authorization'] = 'bearer ' . $token;
		}

		return new Client($data);
	}

	/**
	 * Create pagination
	 *
	 * @param array $items
	 * @param int $perPage
	 * @param int $page
	 * @return mixed
	 */
	private function paginate($items, $perPage = 10, $page = null)
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		$items = $items instanceof Collection ? $items : Collection::make($items);
		return new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page);
	}

	/**
	 * Mapping index list
	 *
	 * @param object $data
	 * @return mixed
	 */
	private function mapping(object $data)
	{
		$daftar_ppk = $data->get()->toArray();
		if (empty($daftar_ppk)) {
			return [];
		}
		foreach ($daftar_ppk as $val) {
			$result[] = [
                'id' => $val['id'],
				'nomor_induk' => $val['nomor_induk'],
				'nama_lengkap' => $val['nama_lengkap'],
				'jenis_kelamin' => $val['jenis_kelamin'],
				'agama' => $val['agama'],
				'nmblok' => $val['nmblok'],
				'checked_val' => $val['checked_val'],
                'id_peserta' => $val['id_peserta']
			];
		}

		return $result;
	}

	/**
	 * Get list
	 *
	 * @param array $data
	 * @param string $url
	 * @return mixed
	 */
	public function search(array $data, $url = null)
	{
		$page = isset($data['page']) ? (int) $data['page'] : 1;
		$perPage = isset($data['per_page']) ? (int) $data['per_page'] : 10;
		$keyword = isset($data['keyword']) ? $data['keyword'] : NULL;
		$sort = isset($data['sort']) ? $data['sort'] : NULL;
		$column = isset($data['column']) ? $data['column'] : 'id';
		$id_jadwal_pk = $data['id_jadwal_pk']??'0';
		$id_jadwal = $data['id_jadwal']??'0';
		$hadir = $data['hadir']??false;


		$q = Identitas::select(['ppk.id as id_peserta','identitas.nomor_induk', 'identitas.id', 'identitas.nama_lengkap', 'drfaga.deskripsi as agama', 'drfkel.deskripsi AS jenis_kelamin', 'blok.deskripsi as nmblok', 'ppk.checked_val']);
		$q = $q->join(DB::raw('(SELECT pk.nomor_induk, pk.id_perkara FROM perkara AS pk inner JOIN (SELECT nomor_induk, max(tgl_entry)  AS tgl_entry FROM perkara WHERE nomor_induk IS NOT NULL  GROUP BY nomor_induk) AS pka ON pk.nomor_induk=pka.nomor_induk AND pk.tgl_entry=pka.tgl_entry) as perkara'), 'identitas.nomor_induk', '=', 'perkara.nomor_induk');
		$q = $q->join('daftar_referensi as drfaga', 'identitas.id_jenis_agama', '=', 'drfaga.id_lookup');
		$q = $q->join('daftar_referensi as drfkel', 'identitas.id_jenis_kelamin', '=', 'drfkel.id_lookup');
		$q = $q->leftJoin(DB::raw('(SELECT mia.perkara_id, mia.kamar_baru_id FROM mutasi_internal as mia inner JOIN (SELECT max(mi.updated_at) AS tglterakhir, mi.perkara_id FROM mutasi_internal AS mi GROUP BY mi.perkara_id) AS mib ON mia.updated_at=mib.tglterakhir AND mia.perkara_id=mib.perkara_id) as mutasi_internal'), 'perkara.id_perkara', '=', 'mutasi_internal.perkara_id');
		$q = $q->leftJoin('kamar', 'mutasi_internal.kamar_baru_id', '=', 'kamar.id');
		$q = $q->leftJoin('blok', 'kamar.blok_id', '=', 'blok.id');

        if(!empty($id_jadwal)){
            $q = $q->join(DB::raw("(SELECT ppk.id_wbp, 1 as checked_val, ppk.id, ppk.kehadiran as hadir FROM peserta_pembinaan_kepribadian AS ppk INNER JOIN daftar_peserta_pembinaan_kepribadian AS dppk ON ppk.id_daftar_peserta_pembinaan_kepribadian=dppk.id WHERE dppk.id_jadwal_pk='" . $id_jadwal . "') as ppk"), 'identitas.id', '=', 'ppk.id_wbp');
        }else{
            $q = $q->leftJoin(DB::raw("(SELECT ppk.id_wbp, 1 as checked_val, ppk.id, ppk.kehadiran as hadir FROM peserta_pembinaan_kepribadian AS ppk INNER JOIN daftar_peserta_pembinaan_kepribadian AS dppk ON ppk.id_daftar_peserta_pembinaan_kepribadian=dppk.id WHERE dppk.id_jadwal_pk='" . $id_jadwal_pk . "') as ppk"), 'identitas.id', '=', 'ppk.id_wbp');
            $q = $q->whereNull('checked_val');
        }

        if($hadir) {
            $q = $q->where('hadir', 1);
        } else {
            $q = $q->whereNull('hadir');
        }

		$data = $this->mapping($q);
		$collection = collect(array_values($data));

		if (!is_null($keyword) && !is_null($column)) {
			$collection = $collection->filter(function ($value, $key) use ($keyword, $column) {
				return (false !== stripos($value[$column], $keyword));
			});
		}

		if (!is_null($sort)) {
			$exSort = explode(',', $sort);
			foreach ($exSort as $key => $value) {
				$xdir = explode(':', $value);
				if (empty($xdir[0])) {
					return response()->json([
						'message' => 'Invalid format sort.'
					]);
				}
				$colSort = $xdir[0];
				$direction = empty($xdir[1]) ? 'asc' : $xdir[1];
				$sorted[] = [$colSort, $direction];
			}
			$collection = $collection->sortBy($sorted);
		}

		$collection->all();
		$paginate = $this->paginate($collection, $perPage, $page);
		$paginate->setPath($url);

		return $paginate;
	}

	/**
	 * Mapping details
	 *
	 * @param object $peserta
	 * @return mixed
	 */
	public function show(object $peserta)
	{
		$data = [
			'nomor_induk' => $peserta->nomor_induk,
			'nama_lengkap' => $peserta->nama_lengkap,
			'jenis_kelamin' => $peserta->jenis_kelamin,
			'agama' => $peserta->agama,
			'nmblok' => $peserta->nmblok,
			'checked_val' => $peserta->checked_val

		];
		return $data;
	}
}
