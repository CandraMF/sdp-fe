<?php

namespace App\Services;

use App\Models\Pegawai;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PegawaiService
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
        $pegawai = $data->get()->toArray();
        if (empty($pegawai)) {
            return [];
        }
        foreach ($pegawai as $val) {
            $result[] = array (
  'id_pegawai' => $val['id_pegawai'],
  'nip' => $val['nip'],
  'nama' => $val['nama'],
  'id_tempat_lahir' => $val['id_tempat_lahir'],
  'tempat_lahir_lain' => $val['tempat_lahir_lain'],
  'tgl_lahir' => $val['tgl_lahir'],
  'id_jenis_kelamin' => $val['id_jenis_kelamin'],
  'alamat' => $val['alamat'],
  'jabatan' => $val['jabatan'],
  'pangkat' => $val['pangkat'],
  'golongan' => $val['golongan'],
  'bagian' => $val['bagian'],
  'email' => $val['email'],
  'telepon' => $val['telepon'],
  'foto' => $val['foto'],
  'id_upt' => $val['id_upt'],
  'konsolidasi' => $val['konsolidasi'],
  'is_active' => $val['is_active'],
  'is_pk' => $val['is_pk'],
  'id_pengunjung_finger' => $val['id_pengunjung_finger'],
  'is_deleted' => $val['is_deleted'],
  'created' => $val['created'],
  'created_by' => $val['created_by'],
  'updated' => $val['updated'],
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
        $column = isset($data['column']) ? $data['column'] : 'id_pegawai';

        $defaultColumn = ["id_pegawai","nip","nama","id_tempat_lahir","tempat_lahir_lain","tgl_lahir","id_jenis_kelamin","alamat","jabatan","pangkat","golongan","bagian","email","telepon","foto","id_upt","konsolidasi","is_active","is_pk","id_pengunjung_finger","is_deleted","created","created_by","updated","updated_by"];
        $q = Pegawai::query();
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
     * @param object $pegawai
     * @return mixed
     */
    public function show(object $pegawai)
    {
        $data = array (
  'id_pegawai' => $pegawai->id_pegawai,
  'nip' => $pegawai->nip,
  'nama' => $pegawai->nama,
  'id_tempat_lahir' => $pegawai->id_tempat_lahir,
  'tempat_lahir_lain' => $pegawai->tempat_lahir_lain,
  'tgl_lahir' => $pegawai->tgl_lahir,
  'id_jenis_kelamin' => $pegawai->id_jenis_kelamin,
  'alamat' => $pegawai->alamat,
  'jabatan' => $pegawai->jabatan,
  'pangkat' => $pegawai->pangkat,
  'golongan' => $pegawai->golongan,
  'bagian' => $pegawai->bagian,
  'email' => $pegawai->email,
  'telepon' => $pegawai->telepon,
  'foto' => $pegawai->foto,
  'id_upt' => $pegawai->id_upt,
  'konsolidasi' => $pegawai->konsolidasi,
  'is_active' => $pegawai->is_active,
  'is_pk' => $pegawai->is_pk,
  'id_pengunjung_finger' => $pegawai->id_pengunjung_finger,
  'is_deleted' => $pegawai->is_deleted,
  'created' => $pegawai->created,
  'created_by' => $pegawai->created_by,
  'updated' => $pegawai->updated,
  'updated_by' => $pegawai->updated_by,
);
        return $data;
    }

}