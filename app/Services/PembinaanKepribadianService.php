<?php

namespace App\Services;

use App\Models\PembinaanKepribadian;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PembinaanKepribadianService
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
        $pembinaan_kepribadian = $data->get()->toArray();
        if (empty($pembinaan_kepribadian)) {
            return [];
        }
        foreach ($pembinaan_kepribadian as $val) {
            $result[] = array (
  'id_pembinaan_kepribadian' => $val['id_pembinaan_kepribadian'],
  'id_jenis_pembinaan_kepribadian' => $val['id_jenis_pembinaan_kepribadian'],
  'id_upt' => $val['id_upt'],
  'id_mitra' => $val['id_mitra'],
  'nama_program' => $val['nama_program'],
  'program_wajib' => $val['program_wajib'],
  'materi_pembinaan_kepribadian' => $val['materi_pembinaan_kepribadian'],
  'id_instruktur' => $val['id_instruktur'],
  'penangung_jawab' => $val['penangung_jawab'],
  'tanggal_mulai' => $val['tanggal_mulai'],
  'tanggal_selesai' => $val['tanggal_selesai'],
  'tempat_pelaksanaan' => $val['tempat_pelaksanaan'],
  'perlu_kelulusan' => $val['perlu_kelulusan'],
  'id_sarana' => $val['id_sarana'],
  'id_prasarana' => $val['id_prasarana'],
  'realisasi_anggaran' => $val['realisasi_anggaran'],
  'id_jenis_anggaran' => $val['id_jenis_anggaran'],
  'foto' => $val['foto'],
  'keterangan' => $val['keterangan'],
  'status' => $val['status'],
  'update_terakhir' => $val['update_terakhir'],
  'update_oleh' => $val['update_oleh'],
);
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
        $column = isset($data['column']) ? $data['column'] : 'id_pembinaan_kepribadian';

        $defaultColumn = ["id_pembinaan_kepribadian","id_jenis_pembinaan_kepribadian","id_upt","id_mitra","nama_program","program_wajib","materi_pembinaan_kepribadian","id_instruktur","penangung_jawab","tanggal_mulai","tanggal_selesai","tempat_pelaksanaan","perlu_kelulusan","id_sarana","id_prasarana","realisasi_anggaran","id_jenis_anggaran","foto","keterangan","status","update_terakhir","update_oleh"];
        $q = PembinaanKepribadian::query();
        $q = $q->select($defaultColumn);
        $data = $this->mapping($q);
        $collection = collect(array_values($data));

        if (!is_null($keyword) && !is_null($column)) {
            $collection = $collection->filter(function ($value, $key) use($keyword, $column) {
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
     * @param object $pembinaan_kepribadian
     * @return mixed
     */
    public function show(object $pembinaan_kepribadian)
    {
        $data = array (
  'id_pembinaan_kepribadian' => $pembinaan_kepribadian->id_pembinaan_kepribadian,
  'id_jenis_pembinaan_kepribadian' => $pembinaan_kepribadian->id_jenis_pembinaan_kepribadian,
  'id_upt' => $pembinaan_kepribadian->id_upt,
  'id_mitra' => $pembinaan_kepribadian->id_mitra,
  'nama_program' => $pembinaan_kepribadian->nama_program,
  'program_wajib' => $pembinaan_kepribadian->program_wajib,
  'materi_pembinaan_kepribadian' => $pembinaan_kepribadian->materi_pembinaan_kepribadian,
  'id_instruktur' => $pembinaan_kepribadian->id_instruktur,
  'penangung_jawab' => $pembinaan_kepribadian->penangung_jawab,
  'tanggal_mulai' => $pembinaan_kepribadian->tanggal_mulai,
  'tanggal_selesai' => $pembinaan_kepribadian->tanggal_selesai,
  'tempat_pelaksanaan' => $pembinaan_kepribadian->tempat_pelaksanaan,
  'perlu_kelulusan' => $pembinaan_kepribadian->perlu_kelulusan,
  'id_sarana' => $pembinaan_kepribadian->id_sarana,
  'id_prasarana' => $pembinaan_kepribadian->id_prasarana,
  'realisasi_anggaran' => $pembinaan_kepribadian->realisasi_anggaran,
  'id_jenis_anggaran' => $pembinaan_kepribadian->id_jenis_anggaran,
  'foto' => $pembinaan_kepribadian->foto,
  'keterangan' => $pembinaan_kepribadian->keterangan,
  'status' => $pembinaan_kepribadian->status,
  'update_terakhir' => $pembinaan_kepribadian->update_terakhir,
  'update_oleh' => $pembinaan_kepribadian->update_oleh,
);
        return $data;
    }

}