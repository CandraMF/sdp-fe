<?php

namespace App\Services;

use App\Models\Upt;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class UptService
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
        $upt = $data->get()->toArray();
        if (empty($upt)) {
            return [];
        }
        foreach ($upt as $val) {
            $result[] = array (
  'id_upt' => $val['id_upt'],
  'uraian' => $val['uraian'],
  'kanwil' => $val['kanwil'],
  'jenis' => $val['jenis'],
  'kelas' => $val['kelas'],
  'kapasitas' => $val['kapasitas'],
  'alamat' => $val['alamat'],
  'telpon' => $val['telpon'],
  'fax' => $val['fax'],
  'kepala_upt' => $val['kepala_upt'],
  'jabatan_ku' => $val['jabatan_ku'],
  'pangkat_ku' => $val['pangkat_ku'],
  'nip_ku' => $val['nip_ku'],
  'pejabat_upt' => $val['pejabat_upt'],
  'jabatan_pu' => $val['jabatan_pu'],
  'pangkat_pu' => $val['pangkat_pu'],
  'nip_pu' => $val['nip_pu'],
  'histori_remisi_tertentu' => $val['histori_remisi_tertentu'],
  'dati2' => $val['dati2'],
  'regf_month' => $val['regf_month'],
  'kapasitas_kunjungan' => $val['kapasitas_kunjungan'],
  'limit_kunjungan' => $val['limit_kunjungan'],
  'tahun_remisi' => $val['tahun_remisi'],
  'limit_tahun_remisi' => $val['limit_tahun_remisi'],
  'lap_reg_scheduler' => $val['lap_reg_scheduler'],
  'tgl_pemberlakuan_permen' => $val['tgl_pemberlakuan_permen'],
  'ip' => $val['ip'],
  'login' => $val['login'],
  'password' => $val['password'],
  'sdp_ada' => $val['sdp_ada'],
  'email' => $val['email'],
  'website' => $val['website'],
  'rupbasan_id' => $val['rupbasan_id'],
  'bapas_id' => $val['bapas_id'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_upt';

        $defaultColumn = ["id_upt","uraian","kanwil","jenis","kelas","kapasitas","alamat","telpon","fax","kepala_upt","jabatan_ku","pangkat_ku","nip_ku","pejabat_upt","jabatan_pu","pangkat_pu","nip_pu","histori_remisi_tertentu","dati2","regf_month","kapasitas_kunjungan","limit_kunjungan","tahun_remisi","limit_tahun_remisi","lap_reg_scheduler","tgl_pemberlakuan_permen","ip","login","password","sdp_ada","email","website","rupbasan_id","bapas_id"];
        $q = Upt::query();
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
     * @param object $upt
     * @return mixed
     */
    public function show(object $upt)
    {
        $data = array (
  'id_upt' => $upt->id_upt,
  'uraian' => $upt->uraian,
  'kanwil' => $upt->kanwil,
  'jenis' => $upt->jenis,
  'kelas' => $upt->kelas,
  'kapasitas' => $upt->kapasitas,
  'alamat' => $upt->alamat,
  'telpon' => $upt->telpon,
  'fax' => $upt->fax,
  'kepala_upt' => $upt->kepala_upt,
  'jabatan_ku' => $upt->jabatan_ku,
  'pangkat_ku' => $upt->pangkat_ku,
  'nip_ku' => $upt->nip_ku,
  'pejabat_upt' => $upt->pejabat_upt,
  'jabatan_pu' => $upt->jabatan_pu,
  'pangkat_pu' => $upt->pangkat_pu,
  'nip_pu' => $upt->nip_pu,
  'histori_remisi_tertentu' => $upt->histori_remisi_tertentu,
  'dati2' => $upt->dati2,
  'regf_month' => $upt->regf_month,
  'kapasitas_kunjungan' => $upt->kapasitas_kunjungan,
  'limit_kunjungan' => $upt->limit_kunjungan,
  'tahun_remisi' => $upt->tahun_remisi,
  'limit_tahun_remisi' => $upt->limit_tahun_remisi,
  'lap_reg_scheduler' => $upt->lap_reg_scheduler,
  'tgl_pemberlakuan_permen' => $upt->tgl_pemberlakuan_permen,
  'ip' => $upt->ip,
  'login' => $upt->login,
  'password' => $upt->password,
  'sdp_ada' => $upt->sdp_ada,
  'email' => $upt->email,
  'website' => $upt->website,
  'rupbasan_id' => $upt->rupbasan_id,
  'bapas_id' => $upt->bapas_id,
);
        return $data;
    }

}