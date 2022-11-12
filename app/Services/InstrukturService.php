<?php

namespace App\Services;

use App\Models\Instruktur;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class InstrukturService
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
        $instruktur = $data->get()->toArray();
        if (empty($instruktur)) {
            return [];
        }
        foreach ($instruktur as $val) {
            $result[] = array (
  'id_instruktur' => $val['id_instruktur'],
  'id_pembinaan_kepribadian' => $val['id_pembinaan_kepribadian'],
  'jenis_instruktur' => $val['jenis_instruktur'],
  'id_napi' => $val['id_napi'],
  'id_petugas' => $val['id_petugas'],
  'id_mitra' => $val['id_mitra'],
  'nama_instruktur' => $val['nama_instruktur'],
  'asal_institusi_instruktur' => $val['asal_institusi_instruktur'],
  'no_telp' => $val['no_telp'],
  'email' => $val['email'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_instruktur';

        $defaultColumn = ["id_instruktur","id_pembinaan_kepribadian","jenis_instruktur","id_napi","id_petugas","id_mitra","nama_instruktur","asal_institusi_instruktur","no_telp","email","keterangan","update_terakhir","update_oleh"];
        $q = Instruktur::query();
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
     * @param object $instruktur
     * @return mixed
     */
    public function show(object $instruktur)
    {
        $data = array (
  'id_instruktur' => $instruktur->id_instruktur,
  'id_pembinaan_kepribadian' => $instruktur->id_pembinaan_kepribadian,
  'jenis_instruktur' => $instruktur->jenis_instruktur,
  'id_napi' => $instruktur->id_napi,
  'id_petugas' => $instruktur->id_petugas,
  'id_mitra' => $instruktur->id_mitra,
  'nama_instruktur' => $instruktur->nama_instruktur,
  'asal_institusi_instruktur' => $instruktur->asal_institusi_instruktur,
  'no_telp' => $instruktur->no_telp,
  'email' => $instruktur->email,
  'keterangan' => $instruktur->keterangan,
  'update_terakhir' => $instruktur->update_terakhir,
  'update_oleh' => $instruktur->update_oleh,
);
        return $data;
    }

}