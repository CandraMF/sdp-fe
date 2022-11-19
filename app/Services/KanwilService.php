<?php

namespace App\Services;

use App\Models\Kanwil;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class KanwilService
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
        $kanwil = $data->get()->toArray();
        if (empty($kanwil)) {
            return [];
        }
        foreach ($kanwil as $val) {
            $result[] = array (
  'kode' => $val['kode'],
  'uraian' => $val['uraian'],
  'sdp_ada' => $val['sdp_ada'],
  'alamat' => $val['alamat'],
  'telpon' => $val['telpon'],
  'fax' => $val['fax'],
  'kepala_kanwil' => $val['kepala_kanwil'],
  'jabatan_kw' => $val['jabatan_kw'],
  'pangkat_kw' => $val['pangkat_kw'],
  'nip_kw' => $val['nip_kw'],
  'pejabat_kanwil' => $val['pejabat_kanwil'],
  'jabatan_pw' => $val['jabatan_pw'],
  'pangkat_pw' => $val['pangkat_pw'],
  'nip_pw' => $val['nip_pw'],
  'ip' => $val['ip'],
  'login' => $val['login'],
  'password' => $val['password'],
  'id_provinsi' => $val['id_provinsi'],
  'id_dati2' => $val['id_dati2'],
  'status_download' => $val['status_download'],
  'email' => $val['email'],
  'website' => $val['website'],
  'konsolidasi' => $val['konsolidasi'],
  'is_konsolidasi_offline' => $val['is_konsolidasi_offline'],
  'nama_aplikasi' => $val['nama_aplikasi'],
  'pin' => $val['pin'],
  'id_timezone' => $val['id_timezone'],
  'versions' => $val['versions'],
  'versions_date' => $val['versions_date'],
  'backup_scheduler' => $val['backup_scheduler'],
  'lap_reg_scheduler' => $val['lap_reg_scheduler'],
  'konsolidasi_scheduler' => $val['konsolidasi_scheduler'],
  'konsolidasi_scheduler_interval' => $val['konsolidasi_scheduler_interval'],
  'konsolidasi_integrasi_scheduler' => $val['konsolidasi_integrasi_scheduler'],
  'terima_data_integrasi_scheduler' => $val['terima_data_integrasi_scheduler'],
  'terima_data_integrasi_scheduler_interval' => $val['terima_data_integrasi_scheduler_interval'],
  'increament_backup_number' => $val['increament_backup_number'],
  'increament_backup_time' => $val['increament_backup_time'],
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
        $column = isset($data['column']) ? $data['column'] : 'kode';

        $defaultColumn = ["kode","uraian","sdp_ada","alamat","telpon","fax","kepala_kanwil","jabatan_kw","pangkat_kw","nip_kw","pejabat_kanwil","jabatan_pw","pangkat_pw","nip_pw","ip","login","password","id_provinsi","id_dati2","status_download","email","website","konsolidasi","is_konsolidasi_offline","nama_aplikasi","pin","id_timezone","versions","versions_date","backup_scheduler","lap_reg_scheduler","konsolidasi_scheduler","konsolidasi_scheduler_interval","konsolidasi_integrasi_scheduler","terima_data_integrasi_scheduler","terima_data_integrasi_scheduler_interval","increament_backup_number","increament_backup_time"];
        $q = Kanwil::query();
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
     * @param object $kanwil
     * @return mixed
     */
    public function show(object $kanwil)
    {
        $data = array (
  'kode' => $kanwil->kode,
  'uraian' => $kanwil->uraian,
  'sdp_ada' => $kanwil->sdp_ada,
  'alamat' => $kanwil->alamat,
  'telpon' => $kanwil->telpon,
  'fax' => $kanwil->fax,
  'kepala_kanwil' => $kanwil->kepala_kanwil,
  'jabatan_kw' => $kanwil->jabatan_kw,
  'pangkat_kw' => $kanwil->pangkat_kw,
  'nip_kw' => $kanwil->nip_kw,
  'pejabat_kanwil' => $kanwil->pejabat_kanwil,
  'jabatan_pw' => $kanwil->jabatan_pw,
  'pangkat_pw' => $kanwil->pangkat_pw,
  'nip_pw' => $kanwil->nip_pw,
  'ip' => $kanwil->ip,
  'login' => $kanwil->login,
  'password' => $kanwil->password,
  'id_provinsi' => $kanwil->id_provinsi,
  'id_dati2' => $kanwil->id_dati2,
  'status_download' => $kanwil->status_download,
  'email' => $kanwil->email,
  'website' => $kanwil->website,
  'konsolidasi' => $kanwil->konsolidasi,
  'is_konsolidasi_offline' => $kanwil->is_konsolidasi_offline,
  'nama_aplikasi' => $kanwil->nama_aplikasi,
  'pin' => $kanwil->pin,
  'id_timezone' => $kanwil->id_timezone,
  'versions' => $kanwil->versions,
  'versions_date' => $kanwil->versions_date,
  'backup_scheduler' => $kanwil->backup_scheduler,
  'lap_reg_scheduler' => $kanwil->lap_reg_scheduler,
  'konsolidasi_scheduler' => $kanwil->konsolidasi_scheduler,
  'konsolidasi_scheduler_interval' => $kanwil->konsolidasi_scheduler_interval,
  'konsolidasi_integrasi_scheduler' => $kanwil->konsolidasi_integrasi_scheduler,
  'terima_data_integrasi_scheduler' => $kanwil->terima_data_integrasi_scheduler,
  'terima_data_integrasi_scheduler_interval' => $kanwil->terima_data_integrasi_scheduler_interval,
  'increament_backup_number' => $kanwil->increament_backup_number,
  'increament_backup_time' => $kanwil->increament_backup_time,
);
        return $data;
    }

}