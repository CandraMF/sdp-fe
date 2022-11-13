<?php

namespace App\Services;

use App\Models\DaftarPesertaPembinaanKepribadian;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DaftarPesertaPembinaanKepribadianService
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
        $daftar_peserta_pembinaan_kepribadian = $data->get()->toArray();
        if (empty($daftar_peserta_pembinaan_kepribadian)) {
            return [];
        }
        foreach ($daftar_peserta_pembinaan_kepribadian as $val) {
            $result[] = array (
  'id_daftar_ppk' => $val['id_daftar_ppk'],
  'id_jadwal_pk' => $val['id_jadwal_pk'],
  'id_peserta' => $val['id_peserta'],
  'status' => $val['status'],
  'keterangan' => $val['keterangan'],
  'update_terakhir' => $val['update_terakhir'],
  'update_oleh' => $val['update_oleh'],
  'verifikasi_oleh' => $val['verifikasi_oleh'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_daftar_ppk';

        $defaultColumn = ["id_daftar_ppk","id_jadwal_pk","id_peserta","status","keterangan","update_terakhir","update_oleh","verifikasi_oleh"];
        $q = DaftarPesertaPembinaanKepribadian::query();
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
     * @param object $daftar_peserta_pembinaan_kepribadian
     * @return mixed
     */
    public function show(object $daftar_peserta_pembinaan_kepribadian)
    {
        $data = array (
  'id_daftar_ppk' => $daftar_peserta_pembinaan_kepribadian->id_daftar_ppk,
  'id_jadwal_pk' => $daftar_peserta_pembinaan_kepribadian->id_jadwal_pk,
  'id_peserta' => $daftar_peserta_pembinaan_kepribadian->id_peserta,
  'status' => $daftar_peserta_pembinaan_kepribadian->status,
  'keterangan' => $daftar_peserta_pembinaan_kepribadian->keterangan,
  'update_terakhir' => $daftar_peserta_pembinaan_kepribadian->update_terakhir,
  'update_oleh' => $daftar_peserta_pembinaan_kepribadian->update_oleh,
  'verifikasi_oleh' => $daftar_peserta_pembinaan_kepribadian->verifikasi_oleh,
);
        return $data;
    }

}