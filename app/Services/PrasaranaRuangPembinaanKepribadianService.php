<?php

namespace App\Services;

use App\Models\PrasaranaRuangPembinaanKepribadian;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PrasaranaRuangPembinaanKepribadianService
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
        $prasarana_ruang_pembinaan_kepribadian = $data->get()->toArray();
        if (empty($prasarana_ruang_pembinaan_kepribadian)) {
            return [];
        }
        foreach ($prasarana_ruang_pembinaan_kepribadian as $val) {
            $result[] = array(
                'id' => $val['id'],
                'id_prasarana_ruang' => $val['id_prasarana_ruang'],
                'id_pembinaan_kepribadian' => $val['id_pembinaan_kepribadian'],
                'updated_at' => $val['updated_at'],
                'updated_by' => $val['updated_by'],
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
        $column = isset($data['column']) ? $data['column'] : 'id';
        $id_pembinaan_kepribadian = isset($data['id_pembinaan_kepribadian']) ? $data['id_pembinaan_kepribadian'] : NULL;

        $defaultColumn = ["id", "id_prasarana_ruang", "id_pembinaan_kepribadian", "updated_at", "updated_by"];
        $q = PrasaranaRuangPembinaanKepribadian::query();
        $q = $q->select($defaultColumn);
        $q = $q->where('id_pembinaan_kepribadian', '=', $id_pembinaan_kepribadian);
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
     * @param object $prasarana_ruang_pembinaan_kepribadian
     * @return mixed
     */
    public function show(object $prasarana_ruang_pembinaan_kepribadian)
    {
        $data = array(
            'id' => $prasarana_ruang_pembinaan_kepribadian->id,
            'id_prasarana_ruang' => $prasarana_ruang_pembinaan_kepribadian->id_prasarana_ruang,
            'id_pembinaan_kepribadian' => $prasarana_ruang_pembinaan_kepribadian->id_pembinaan_kepribadian,
            'updated_at' => $prasarana_ruang_pembinaan_kepribadian->updated_at,
            'updated_by' => $prasarana_ruang_pembinaan_kepribadian->updated_by,
        );
        return $data;
    }
}
