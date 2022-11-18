<?php

namespace App\Services;

use App\Models\DaftarReferensi;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DaftarReferensiService
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
        $daftar_referensi = $data->get()->toArray();
        if (empty($daftar_referensi)) {
            return [];
        }
        foreach ($daftar_referensi as $val) {
            $result[] = array(
                'id_lookup' => $val['id_lookup'],
                'groups' => $val['groups'],
                'deskripsi' => $val['deskripsi'],
                'catatan' => $val['catatan'],
                'content' => $val['content'],
                'status_download' => $val['status_download'],
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
        $groups = isset($data['groups']) ? $data['groups'] : NULL;
        $column = isset($data['column']) ? $data['column'] : 'id_lookup';



        $defaultColumn = ["id_lookup", "groups", "deskripsi", "catatan", "content", "status_download"];
        $q = DaftarReferensi::query();
        $q = $q->select($defaultColumn);
        $q = $q->where('groups', '=', $groups);
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
     * @param object $daftar_referensi
     * @return mixed
     */
    public function show(object $daftar_referensi)
    {
        $data = array(
            'id_lookup' => $daftar_referensi->id_lookup,
            'groups' => $daftar_referensi->groups,
            'deskripsi' => $daftar_referensi->deskripsi,
            'catatan' => $daftar_referensi->catatan,
            'content' => $daftar_referensi->content,
            'status_download' => $daftar_referensi->status_download,
        );
        return $data;
    }
}
