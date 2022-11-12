<?php

namespace App\Services;

use App\Models\Mitra;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class MitraService
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
        $mitra = $data->get()->toArray();
        if (empty($mitra)) {
            return [];
        }
        foreach ($mitra as $val) {
            $result[] = array (
  'id_mitra' => $val['id_mitra'],
  'nama_mitra' => $val['nama_mitra'],
  'nama_pic' => $val['nama_pic'],
  'alamat' => $val['alamat'],
  'id_dati2' => $val['id_dati2'],
  'no_telp' => $val['no_telp'],
  'no_hp' => $val['no_hp'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_mitra';

        $defaultColumn = ["id_mitra","nama_mitra","nama_pic","alamat","id_dati2","no_telp","no_hp","email","keterangan","update_terakhir","update_oleh"];
        $q = Mitra::query();
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
     * @param object $mitra
     * @return mixed
     */
    public function show(object $mitra)
    {
        $data = array (
  'id_mitra' => $mitra->id_mitra,
  'nama_mitra' => $mitra->nama_mitra,
  'nama_pic' => $mitra->nama_pic,
  'alamat' => $mitra->alamat,
  'id_dati2' => $mitra->id_dati2,
  'no_telp' => $mitra->no_telp,
  'no_hp' => $mitra->no_hp,
  'email' => $mitra->email,
  'keterangan' => $mitra->keterangan,
  'update_terakhir' => $mitra->update_terakhir,
  'update_oleh' => $mitra->update_oleh,
);
        return $data;
    }

}