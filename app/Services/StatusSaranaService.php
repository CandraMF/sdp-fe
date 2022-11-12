<?php

namespace App\Services;

use App\Models\StatusSarana;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class StatusSaranaService
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
        $status_sarana = $data->get()->toArray();
        if (empty($status_sarana)) {
            return [];
        }
        foreach ($status_sarana as $val) {
            $result[] = array (
  'id_status_sarana' => $val['id_status_sarana'],
  'id_sarana' => $val['id_sarana'],
  'tahun' => $val['tahun'],
  'bulan' => $val['bulan'],
  'status' => $val['status'],
  'kepemilkan' => $val['kepemilkan'],
  'jumlah' => $val['jumlah'],
  'satuan' => $val['satuan'],
  'kondisi_baik' => $val['kondisi_baik'],
  'kondisi_rusak' => $val['kondisi_rusak'],
  'foto' => $val['foto'],
  'keterangan' => $val['keterangan'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_status_sarana';

        $defaultColumn = ["id_status_sarana","id_sarana","tahun","bulan","status","kepemilkan","jumlah","satuan","kondisi_baik","kondisi_rusak","foto","keterangan","update_terakhir","update_oleh"];
        $q = StatusSarana::query();
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
     * @param object $status_sarana
     * @return mixed
     */
    public function show(object $status_sarana)
    {
        $data = array (
  'id_status_sarana' => $status_sarana->id_status_sarana,
  'id_sarana' => $status_sarana->id_sarana,
  'tahun' => $status_sarana->tahun,
  'bulan' => $status_sarana->bulan,
  'status' => $status_sarana->status,
  'kepemilkan' => $status_sarana->kepemilkan,
  'jumlah' => $status_sarana->jumlah,
  'satuan' => $status_sarana->satuan,
  'kondisi_baik' => $status_sarana->kondisi_baik,
  'kondisi_rusak' => $status_sarana->kondisi_rusak,
  'foto' => $status_sarana->foto,
  'keterangan' => $status_sarana->keterangan,
  'update_terakhir' => $status_sarana->update_terakhir,
  'update_oleh' => $status_sarana->update_oleh,
);
        return $data;
    }

}