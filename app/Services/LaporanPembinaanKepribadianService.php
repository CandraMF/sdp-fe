<?php

namespace App\Services;

use App\Models\LaporanPembinaanKepribadian;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class LaporanPembinaanKepribadianService
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
        $laporan_pembinaan_kepribadian = $data->get()->toArray();
        if (empty($laporan_pembinaan_kepribadian)) {
            return [];
        }
        foreach ($laporan_pembinaan_kepribadian as $val) {
            $result[] = array (
  'id_laporan_pk' => $val['id_laporan_pk'],
  'id_pembinaan_kepribadian' => $val['id_pembinaan_kepribadian'],
  'id_upt' => $val['id_upt'],
  'bulan' => $val['bulan'],
  'tahun' => $val['tahun'],
  'jumlah_hari' => $val['jumlah_hari'],
  'jumlah_pembinaan_kepribadian' => $val['jumlah_pembinaan_kepribadian'],
  'jumlah_peserta' => $val['jumlah_peserta'],
  'jumlah_instruktur_petugas' => $val['jumlah_instruktur_petugas'],
  'jumlah_instruktur_napi' => $val['jumlah_instruktur_napi'],
  'jumlah_instruktur_instansi_lain' => $val['jumlah_instruktur_instansi_lain'],
  'jumlah_instruktur_mitra' => $val['jumlah_instruktur_mitra'],
  'keterangan' => $val['keterangan'],
  'status' => $val['status'],
  'verifikasi_upt' => $val['verifikasi_upt'],
  'verifikasi_kanwil' => $val['verifikasi_kanwil'],
  'verifikasi_ditjen' => $val['verifikasi_ditjen'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_laporan_pk';

        $defaultColumn = ["id_laporan_pk","id_pembinaan_kepribadian","id_upt","bulan","tahun","jumlah_hari","jumlah_pembinaan_kepribadian","jumlah_peserta","jumlah_instruktur_petugas","jumlah_instruktur_napi","jumlah_instruktur_instansi_lain","jumlah_instruktur_mitra","keterangan","status","verifikasi_upt","verifikasi_kanwil","verifikasi_ditjen","update_terakhir","update_oleh"];
        $q = LaporanPembinaanKepribadian::query();
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
     * @param object $laporan_pembinaan_kepribadian
     * @return mixed
     */
    public function show(object $laporan_pembinaan_kepribadian)
    {
        $data = array (
  'id_laporan_pk' => $laporan_pembinaan_kepribadian->id_laporan_pk,
  'id_pembinaan_kepribadian' => $laporan_pembinaan_kepribadian->id_pembinaan_kepribadian,
  'id_upt' => $laporan_pembinaan_kepribadian->id_upt,
  'bulan' => $laporan_pembinaan_kepribadian->bulan,
  'tahun' => $laporan_pembinaan_kepribadian->tahun,
  'jumlah_hari' => $laporan_pembinaan_kepribadian->jumlah_hari,
  'jumlah_pembinaan_kepribadian' => $laporan_pembinaan_kepribadian->jumlah_pembinaan_kepribadian,
  'jumlah_peserta' => $laporan_pembinaan_kepribadian->jumlah_peserta,
  'jumlah_instruktur_petugas' => $laporan_pembinaan_kepribadian->jumlah_instruktur_petugas,
  'jumlah_instruktur_napi' => $laporan_pembinaan_kepribadian->jumlah_instruktur_napi,
  'jumlah_instruktur_instansi_lain' => $laporan_pembinaan_kepribadian->jumlah_instruktur_instansi_lain,
  'jumlah_instruktur_mitra' => $laporan_pembinaan_kepribadian->jumlah_instruktur_mitra,
  'keterangan' => $laporan_pembinaan_kepribadian->keterangan,
  'status' => $laporan_pembinaan_kepribadian->status,
  'verifikasi_upt' => $laporan_pembinaan_kepribadian->verifikasi_upt,
  'verifikasi_kanwil' => $laporan_pembinaan_kepribadian->verifikasi_kanwil,
  'verifikasi_ditjen' => $laporan_pembinaan_kepribadian->verifikasi_ditjen,
  'update_terakhir' => $laporan_pembinaan_kepribadian->update_terakhir,
  'update_oleh' => $laporan_pembinaan_kepribadian->update_oleh,
);
        return $data;
    }

}