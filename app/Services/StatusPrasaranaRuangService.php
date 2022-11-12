<?php

namespace App\Services;

use App\Models\StatusPrasaranaRuang;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class StatusPrasaranaRuangService
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
        $status_prasarana_ruang = $data->get()->toArray();
        if (empty($status_prasarana_ruang)) {
            return [];
        }
        foreach ($status_prasarana_ruang as $val) {
            $result[] = array (
  'id_status_prasarana_ruang' => $val['id_status_prasarana_ruang'],
  'id_prasarana_ruang' => $val['id_prasarana_ruang'],
  'tahun' => $val['tahun'],
  'bulan' => $val['bulan'],
  'status' => $val['status'],
  'kepemilkan' => $val['kepemilkan'],
  'luas' => $val['luas'],
  'satuan_luas' => $val['satuan_luas'],
  'jumlah_lantai' => $val['jumlah_lantai'],
  'jumlah_ruang' => $val['jumlah_ruang'],
  'kondisi_baik' => $val['kondisi_baik'],
  'kondisi_rusak' => $val['kondisi_rusak'],
  'satuan_kondisi' => $val['satuan_kondisi'],
  'foto' => $val['foto'],
  'pendaftaran_disnaker' => $val['pendaftaran_disnaker'],
  'catatan_disnaker' => $val['catatan_disnaker'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_status_prasarana_ruang';

        $defaultColumn = ["id_status_prasarana_ruang","id_prasarana_ruang","tahun","bulan","status","kepemilkan","luas","satuan_luas","jumlah_lantai","jumlah_ruang","kondisi_baik","kondisi_rusak","satuan_kondisi","foto","pendaftaran_disnaker","catatan_disnaker","keterangan","update_terakhir","update_oleh"];
        $q = StatusPrasaranaRuang::query();
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
     * @param object $status_prasarana_ruang
     * @return mixed
     */
    public function show(object $status_prasarana_ruang)
    {
        $data = array (
  'id_status_prasarana_ruang' => $status_prasarana_ruang->id_status_prasarana_ruang,
  'id_prasarana_ruang' => $status_prasarana_ruang->id_prasarana_ruang,
  'tahun' => $status_prasarana_ruang->tahun,
  'bulan' => $status_prasarana_ruang->bulan,
  'status' => $status_prasarana_ruang->status,
  'kepemilkan' => $status_prasarana_ruang->kepemilkan,
  'luas' => $status_prasarana_ruang->luas,
  'satuan_luas' => $status_prasarana_ruang->satuan_luas,
  'jumlah_lantai' => $status_prasarana_ruang->jumlah_lantai,
  'jumlah_ruang' => $status_prasarana_ruang->jumlah_ruang,
  'kondisi_baik' => $status_prasarana_ruang->kondisi_baik,
  'kondisi_rusak' => $status_prasarana_ruang->kondisi_rusak,
  'satuan_kondisi' => $status_prasarana_ruang->satuan_kondisi,
  'foto' => $status_prasarana_ruang->foto,
  'pendaftaran_disnaker' => $status_prasarana_ruang->pendaftaran_disnaker,
  'catatan_disnaker' => $status_prasarana_ruang->catatan_disnaker,
  'keterangan' => $status_prasarana_ruang->keterangan,
  'update_terakhir' => $status_prasarana_ruang->update_terakhir,
  'update_oleh' => $status_prasarana_ruang->update_oleh,
);
        return $data;
    }

}