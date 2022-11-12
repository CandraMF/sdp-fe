<?php

namespace App\Services;

use App\Models\MitraKontrak;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class MitraKontrakService
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
        $mitra_kontrak = $data->get()->toArray();
        if (empty($mitra_kontrak)) {
            return [];
        }
        foreach ($mitra_kontrak as $val) {
            $result[] = array (
  'id_kontrak' => $val['id_kontrak'],
  'id_mitra' => $val['id_mitra'],
  'jenis_mitra' => $val['jenis_mitra'],
  'kontrak_dengan' => $val['kontrak_dengan'],
  'id_kanwil' => $val['id_kanwil'],
  'id_upt' => $val['id_upt'],
  'nomor_kontrak' => $val['nomor_kontrak'],
  'kontrak_awal' => $val['kontrak_awal'],
  'kontrak_akhir' => $val['kontrak_akhir'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_kontrak';

        $defaultColumn = ["id_kontrak","id_mitra","jenis_mitra","kontrak_dengan","id_kanwil","id_upt","nomor_kontrak","kontrak_awal","kontrak_akhir","update_terakhir","update_oleh"];
        $q = MitraKontrak::query();
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
     * @param object $mitra_kontrak
     * @return mixed
     */
    public function show(object $mitra_kontrak)
    {
        $data = array (
  'id_kontrak' => $mitra_kontrak->id_kontrak,
  'id_mitra' => $mitra_kontrak->id_mitra,
  'jenis_mitra' => $mitra_kontrak->jenis_mitra,
  'kontrak_dengan' => $mitra_kontrak->kontrak_dengan,
  'id_kanwil' => $mitra_kontrak->id_kanwil,
  'id_upt' => $mitra_kontrak->id_upt,
  'nomor_kontrak' => $mitra_kontrak->nomor_kontrak,
  'kontrak_awal' => $mitra_kontrak->kontrak_awal,
  'kontrak_akhir' => $mitra_kontrak->kontrak_akhir,
  'update_terakhir' => $mitra_kontrak->update_terakhir,
  'update_oleh' => $mitra_kontrak->update_oleh,
);
        return $data;
    }

}