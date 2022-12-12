<?php

namespace App\Services;

use App\Models\JadwalPelatihanKeterampilan;
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


class JadwalPelatihanKeterampilanService
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
		$jadwal_pelatihan_keterampilan  = $data->get()->toArray();
		if (empty($jadwal_pelatihan_keterampilan)) {
			return [];
		}
		foreach ($jadwal_pelatihan_keterampilan  as $val) {
			$result[] = [

				'id' => $val['id'],
				'id_pelatihan_keterampilan' => $val['id_pelatihan_keterampilan'],
				'tanggal' => $val['tanggal'],
				'jam_mulai' => $val['jam_mulai'],
				'jam_selesai' => $val['jam_selesai'],
				'id_instruktur' => $val['id_instruktur'],
				'materi_pelatihan_keterampilan' => $val['materi_pelatihan_keterampilan'],
				'foto' => $val['foto'],
				'status' => $val['status']
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


		$defaultColumn = ['id', 'id_pelatihan_keterampilan', 'tanggal', 'jam_mulai', 'jam_selesai', 'id_instruktur', 'materi_pelatihan_keterampilan', 'foto', 'status'];
		$q = JadwalPelatihanKeterampilan::query();
		$q = $q->select($defaultColumn);


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
	 * @param object $jadwal_pelatihan_keterampilan 
	 * @return mixed
	 */
	public function show(object $jadwal_pelatihan_keterampilan)
	{
		$data = [
			'id' => $jadwal_pelatihan_keterampilan->id,
			'id_pelatihan_keterampilan' => $jadwal_pelatihan_keterampilan->id_pelatihan_keterampilan,
			'tanggal' => $jadwal_pelatihan_keterampilan->tanggal,
			'jam_mulai' => $jadwal_pelatihan_keterampilan->jam_mulai,
			'jam_selesai' => $jadwal_pelatihan_keterampilan->jam_selesai,
			'id_instruktur' => $jadwal_pelatihan_keterampilan->id_instruktur,
			'materi_pelatihan_keterampilan' => $jadwal_pelatihan_keterampilan->materi_pelatihan_keterampilan,
			'foto' => $jadwal_pelatihan_keterampilan->foto, 'status' => $jadwal_pelatihan_keterampilan->status
		];
		return $data;
	}
}
