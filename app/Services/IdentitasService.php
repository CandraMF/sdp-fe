<?php

namespace App\Services;

use App\Models\Identitas;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class IdentitasService
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
        $identitas = $data->get()->toArray();
        if (empty($identitas)) {
            return [];
        }
        foreach ($identitas as $val) {
            $result[] = array (
  'id' => $val['id'],
  'nomor_induk' => $val['nomor_induk'],
  'id_jenis_suku' => $val['id_jenis_suku'],
  'id_jenis_suku_lain' => $val['id_jenis_suku_lain'],
  'id_jenis_rambut' => $val['id_jenis_rambut'],
  'id_jenis_muka' => $val['id_jenis_muka'],
  'id_jenis_pendidikan' => $val['id_jenis_pendidikan'],
  'id_jenis_pendidikan_lain' => $val['id_jenis_pendidikan_lain'],
  'id_jenis_tangan' => $val['id_jenis_tangan'],
  'id_jenis_agama' => $val['id_jenis_agama'],
  'id_jenis_agama_lain' => $val['id_jenis_agama_lain'],
  'id_jenis_pekerjaan' => $val['id_jenis_pekerjaan'],
  'id_jenis_pekerjaan_lain' => $val['id_jenis_pekerjaan_lain'],
  'nama_instansi_pns' => $val['nama_instansi_pns'],
  'nip' => $val['nip'],
  'id_user' => $val['id_user'],
  'id_bentuk_mata' => $val['id_bentuk_mata'],
  'id_warna_mata' => $val['id_warna_mata'],
  'id_jenis_keahlian_2' => $val['id_jenis_keahlian_2'],
  'id_jenis_keahlian_2_lain' => $val['id_jenis_keahlian_2_lain'],
  'id_jenis_hidung' => $val['id_jenis_hidung'],
  'id_jenis_level_1' => $val['id_jenis_level_1'],
  'id_jenis_mulut' => $val['id_jenis_mulut'],
  'id_jenis_level_2' => $val['id_jenis_level_2'],
  'id_jenis_warganegara' => $val['id_jenis_warganegara'],
  'id_negara_asing' => $val['id_negara_asing'],
  'id_propinsi' => $val['id_propinsi'],
  'id_propinsi_lain' => $val['id_propinsi_lain'],
  'id_jenis_status_perkawinan' => $val['id_jenis_status_perkawinan'],
  'id_jenis_kelamin' => $val['id_jenis_kelamin'],
  'id_jenis_kaki' => $val['id_jenis_kaki'],
  'id_jenis_keahlian_1' => $val['id_jenis_keahlian_1'],
  'id_jenis_keahlian_1_lain' => $val['id_jenis_keahlian_1_lain'],
  'id_tempat_lahir' => $val['id_tempat_lahir'],
  'id_tempat_lahir_lain' => $val['id_tempat_lahir_lain'],
  'id_kota' => $val['id_kota'],
  'id_kota_lain' => $val['id_kota_lain'],
  'id_tempat_asal' => $val['id_tempat_asal'],
  'id_tempat_asal_lain' => $val['id_tempat_asal_lain'],
  'residivis' => $val['residivis'],
  'residivis_counter' => $val['residivis_counter'],
  'nik' => $val['nik'],
  'nama_lengkap' => $val['nama_lengkap'],
  'nama_alias1' => $val['nama_alias1'],
  'nama_alias2' => $val['nama_alias2'],
  'nama_alias3' => $val['nama_alias3'],
  'nama_kecil1' => $val['nama_kecil1'],
  'nama_kecil2' => $val['nama_kecil2'],
  'nama_kecil3' => $val['nama_kecil3'],
  'tanggal_lahir' => $val['tanggal_lahir'],
  'is_wbp_beresiko_tinggi' => $val['is_wbp_beresiko_tinggi'],
  'is_pengaruh_terhadap_masyarakat' => $val['is_pengaruh_terhadap_masyarakat'],
  'is_baca_latin' => $val['is_baca_latin'],
  'is_baca_quran' => $val['is_baca_quran'],
  'alamat' => $val['alamat'],
  'alamat_alternatif' => $val['alamat_alternatif'],
  'kodepos' => $val['kodepos'],
  'telepon' => $val['telepon'],
  'alamat_pekerjaan' => $val['alamat_pekerjaan'],
  'keterangan_pekerjaan' => $val['keterangan_pekerjaan'],
  'minat' => $val['minat'],
  'nm_ayah' => $val['nm_ayah'],
  'tmp_tgl_ayah' => $val['tmp_tgl_ayah'],
  'nm_ibu' => $val['nm_ibu'],
  'tmp_tgl_ibu' => $val['tmp_tgl_ibu'],
  'nm_saudara_ori' => $val['nm_saudara_ori'],
  'nm_saudara' => $val['nm_saudara'],
  'anakke' => $val['anakke'],
  'jml_saudara' => $val['jml_saudara'],
  'jml_istri_suami' => $val['jml_istri_suami'],
  'nm_istri_suami_ori' => $val['nm_istri_suami_ori'],
  'nm_istri_suami' => $val['nm_istri_suami'],
  'tmp_tgl_istri_suami' => $val['tmp_tgl_istri_suami'],
  'jml_anak' => $val['jml_anak'],
  'nm_anak_ori' => $val['nm_anak_ori'],
  'nm_anak' => $val['nm_anak'],
  'telephone_keluarga' => $val['telephone_keluarga'],
  'tinggi' => $val['tinggi'],
  'berat' => $val['berat'],
  'cacat' => $val['cacat'],
  'ciri' => $val['ciri'],
  'ciri2' => $val['ciri2'],
  'ciri3' => $val['ciri3'],
  'foto_depan' => $val['foto_depan'],
  'foto_kanan' => $val['foto_kanan'],
  'foto_kiri' => $val['foto_kiri'],
  'foto_ciri_1' => $val['foto_ciri_1'],
  'foto_ciri_2' => $val['foto_ciri_2'],
  'foto_ciri_3' => $val['foto_ciri_3'],
  'konsolidasi' => $val['konsolidasi'],
  'konsolidasi_image' => $val['konsolidasi_image'],
  'id_telinga' => $val['id_telinga'],
  'id_kacamata' => $val['id_kacamata'],
  'id_warnakulit' => $val['id_warnakulit'],
  'id_bentukrambut' => $val['id_bentukrambut'],
  'id_bentukbibir' => $val['id_bentukbibir'],
  'id_lengan' => $val['id_lengan'],
  'id_tingkat_penghasilan' => $val['id_tingkat_penghasilan'],
  'nomor_induk_nasional' => $val['nomor_induk_nasional'],
  'is_verifikasi' => $val['is_verifikasi'],
  'is_deleted' => $val['is_deleted'],
  'created' => $val['created'],
  'updated' => $val['updated'],
  'created_by' => $val['created_by'],
  'created_by_role' => $val['created_by_role'],
  'updated_by' => $val['updated_by'],
  'updated_by_role' => $val['updated_by_role'],
  'deleted_at' => $val['deleted_at'],
  'created_at' => $val['created_at'],
  'updated_at' => $val['updated_at'],
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

        $defaultColumn = ["id","nomor_induk","id_jenis_suku","id_jenis_suku_lain","id_jenis_rambut","id_jenis_muka","id_jenis_pendidikan","id_jenis_pendidikan_lain","id_jenis_tangan","id_jenis_agama","id_jenis_agama_lain","id_jenis_pekerjaan","id_jenis_pekerjaan_lain","nama_instansi_pns","nip","id_user","id_bentuk_mata","id_warna_mata","id_jenis_keahlian_2","id_jenis_keahlian_2_lain","id_jenis_hidung","id_jenis_level_1","id_jenis_mulut","id_jenis_level_2","id_jenis_warganegara","id_negara_asing","id_propinsi","id_propinsi_lain","id_jenis_status_perkawinan","id_jenis_kelamin","id_jenis_kaki","id_jenis_keahlian_1","id_jenis_keahlian_1_lain","id_tempat_lahir","id_tempat_lahir_lain","id_kota","id_kota_lain","id_tempat_asal","id_tempat_asal_lain","residivis","residivis_counter","nik","nama_lengkap","nama_alias1","nama_alias2","nama_alias3","nama_kecil1","nama_kecil2","nama_kecil3","tanggal_lahir","is_wbp_beresiko_tinggi","is_pengaruh_terhadap_masyarakat","is_baca_latin","is_baca_quran","alamat","alamat_alternatif","kodepos","telepon","alamat_pekerjaan","keterangan_pekerjaan","minat","nm_ayah","tmp_tgl_ayah","nm_ibu","tmp_tgl_ibu","nm_saudara_ori","nm_saudara","anakke","jml_saudara","jml_istri_suami","nm_istri_suami_ori","nm_istri_suami","tmp_tgl_istri_suami","jml_anak","nm_anak_ori","nm_anak","telephone_keluarga","tinggi","berat","cacat","ciri","ciri2","ciri3","foto_depan","foto_kanan","foto_kiri","foto_ciri_1","foto_ciri_2","foto_ciri_3","konsolidasi","konsolidasi_image","id_telinga","id_kacamata","id_warnakulit","id_bentukrambut","id_bentukbibir","id_lengan","id_tingkat_penghasilan","nomor_induk_nasional","is_verifikasi","is_deleted","created","updated","created_by","created_by_role","updated_by","updated_by_role","deleted_at","created_at","updated_at"];
        $q = Identitas::query();
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
     * @param object $identitas
     * @return mixed
     */
    public function show(object $identitas)
    {
        $data = array (
  'id' => $identitas->id,
  'nomor_induk' => $identitas->nomor_induk,
  'id_jenis_suku' => $identitas->id_jenis_suku,
  'id_jenis_suku_lain' => $identitas->id_jenis_suku_lain,
  'id_jenis_rambut' => $identitas->id_jenis_rambut,
  'id_jenis_muka' => $identitas->id_jenis_muka,
  'id_jenis_pendidikan' => $identitas->id_jenis_pendidikan,
  'id_jenis_pendidikan_lain' => $identitas->id_jenis_pendidikan_lain,
  'id_jenis_tangan' => $identitas->id_jenis_tangan,
  'id_jenis_agama' => $identitas->id_jenis_agama,
  'id_jenis_agama_lain' => $identitas->id_jenis_agama_lain,
  'id_jenis_pekerjaan' => $identitas->id_jenis_pekerjaan,
  'id_jenis_pekerjaan_lain' => $identitas->id_jenis_pekerjaan_lain,
  'nama_instansi_pns' => $identitas->nama_instansi_pns,
  'nip' => $identitas->nip,
  'id_user' => $identitas->id_user,
  'id_bentuk_mata' => $identitas->id_bentuk_mata,
  'id_warna_mata' => $identitas->id_warna_mata,
  'id_jenis_keahlian_2' => $identitas->id_jenis_keahlian_2,
  'id_jenis_keahlian_2_lain' => $identitas->id_jenis_keahlian_2_lain,
  'id_jenis_hidung' => $identitas->id_jenis_hidung,
  'id_jenis_level_1' => $identitas->id_jenis_level_1,
  'id_jenis_mulut' => $identitas->id_jenis_mulut,
  'id_jenis_level_2' => $identitas->id_jenis_level_2,
  'id_jenis_warganegara' => $identitas->id_jenis_warganegara,
  'id_negara_asing' => $identitas->id_negara_asing,
  'id_propinsi' => $identitas->id_propinsi,
  'id_propinsi_lain' => $identitas->id_propinsi_lain,
  'id_jenis_status_perkawinan' => $identitas->id_jenis_status_perkawinan,
  'id_jenis_kelamin' => $identitas->id_jenis_kelamin,
  'id_jenis_kaki' => $identitas->id_jenis_kaki,
  'id_jenis_keahlian_1' => $identitas->id_jenis_keahlian_1,
  'id_jenis_keahlian_1_lain' => $identitas->id_jenis_keahlian_1_lain,
  'id_tempat_lahir' => $identitas->id_tempat_lahir,
  'id_tempat_lahir_lain' => $identitas->id_tempat_lahir_lain,
  'id_kota' => $identitas->id_kota,
  'id_kota_lain' => $identitas->id_kota_lain,
  'id_tempat_asal' => $identitas->id_tempat_asal,
  'id_tempat_asal_lain' => $identitas->id_tempat_asal_lain,
  'residivis' => $identitas->residivis,
  'residivis_counter' => $identitas->residivis_counter,
  'nik' => $identitas->nik,
  'nama_lengkap' => $identitas->nama_lengkap,
  'nama_alias1' => $identitas->nama_alias1,
  'nama_alias2' => $identitas->nama_alias2,
  'nama_alias3' => $identitas->nama_alias3,
  'nama_kecil1' => $identitas->nama_kecil1,
  'nama_kecil2' => $identitas->nama_kecil2,
  'nama_kecil3' => $identitas->nama_kecil3,
  'tanggal_lahir' => $identitas->tanggal_lahir,
  'is_wbp_beresiko_tinggi' => $identitas->is_wbp_beresiko_tinggi,
  'is_pengaruh_terhadap_masyarakat' => $identitas->is_pengaruh_terhadap_masyarakat,
  'is_baca_latin' => $identitas->is_baca_latin,
  'is_baca_quran' => $identitas->is_baca_quran,
  'alamat' => $identitas->alamat,
  'alamat_alternatif' => $identitas->alamat_alternatif,
  'kodepos' => $identitas->kodepos,
  'telepon' => $identitas->telepon,
  'alamat_pekerjaan' => $identitas->alamat_pekerjaan,
  'keterangan_pekerjaan' => $identitas->keterangan_pekerjaan,
  'minat' => $identitas->minat,
  'nm_ayah' => $identitas->nm_ayah,
  'tmp_tgl_ayah' => $identitas->tmp_tgl_ayah,
  'nm_ibu' => $identitas->nm_ibu,
  'tmp_tgl_ibu' => $identitas->tmp_tgl_ibu,
  'nm_saudara_ori' => $identitas->nm_saudara_ori,
  'nm_saudara' => $identitas->nm_saudara,
  'anakke' => $identitas->anakke,
  'jml_saudara' => $identitas->jml_saudara,
  'jml_istri_suami' => $identitas->jml_istri_suami,
  'nm_istri_suami_ori' => $identitas->nm_istri_suami_ori,
  'nm_istri_suami' => $identitas->nm_istri_suami,
  'tmp_tgl_istri_suami' => $identitas->tmp_tgl_istri_suami,
  'jml_anak' => $identitas->jml_anak,
  'nm_anak_ori' => $identitas->nm_anak_ori,
  'nm_anak' => $identitas->nm_anak,
  'telephone_keluarga' => $identitas->telephone_keluarga,
  'tinggi' => $identitas->tinggi,
  'berat' => $identitas->berat,
  'cacat' => $identitas->cacat,
  'ciri' => $identitas->ciri,
  'ciri2' => $identitas->ciri2,
  'ciri3' => $identitas->ciri3,
  'foto_depan' => $identitas->foto_depan,
  'foto_kanan' => $identitas->foto_kanan,
  'foto_kiri' => $identitas->foto_kiri,
  'foto_ciri_1' => $identitas->foto_ciri_1,
  'foto_ciri_2' => $identitas->foto_ciri_2,
  'foto_ciri_3' => $identitas->foto_ciri_3,
  'konsolidasi' => $identitas->konsolidasi,
  'konsolidasi_image' => $identitas->konsolidasi_image,
  'id_telinga' => $identitas->id_telinga,
  'id_kacamata' => $identitas->id_kacamata,
  'id_warnakulit' => $identitas->id_warnakulit,
  'id_bentukrambut' => $identitas->id_bentukrambut,
  'id_bentukbibir' => $identitas->id_bentukbibir,
  'id_lengan' => $identitas->id_lengan,
  'id_tingkat_penghasilan' => $identitas->id_tingkat_penghasilan,
  'nomor_induk_nasional' => $identitas->nomor_induk_nasional,
  'is_verifikasi' => $identitas->is_verifikasi,
  'is_deleted' => $identitas->is_deleted,
  'created' => $identitas->created,
  'updated' => $identitas->updated,
  'created_by' => $identitas->created_by,
  'created_by_role' => $identitas->created_by_role,
  'updated_by' => $identitas->updated_by,
  'updated_by_role' => $identitas->updated_by_role,
  'deleted_at' => $identitas->deleted_at,
  'created_at' => $identitas->created_at,
  'updated_at' => $identitas->updated_at,
);
        return $data;
    }

}