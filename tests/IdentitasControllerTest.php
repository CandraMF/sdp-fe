<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Identitas;

class IdentitasControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexIdentitas()
    {
        $data = factory(Identitas::class)->create();
        $this->json('GET', '/identitas', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreIdentitas()
    {
        $data = factory(Identitas::class)->create();
        $properties = [
                'nomor_induk' => '1' , 'id_jenis_suku' => '1' , 'id_jenis_suku_lain' => '1' , 'id_jenis_rambut' => '1' , 'id_jenis_muka' => '1' , 'id_jenis_pendidikan' => '1' , 'id_jenis_pendidikan_lain' => '1' , 'id_jenis_tangan' => '1' , 'id_jenis_agama' => '1' , 'id_jenis_agama_lain' => '1' , 'id_jenis_pekerjaan' => '1' , 'id_jenis_pekerjaan_lain' => '1' , 'nama_instansi_pns' => '1' , 'nip' => '1' , 'id_user' => '1' , 'id_bentuk_mata' => '1' , 'id_warna_mata' => '1' , 'id_jenis_keahlian_2' => '1' , 'id_jenis_keahlian_2_lain' => '1' , 'id_jenis_hidung' => '1' , 'id_jenis_level_1' => '1' , 'id_jenis_mulut' => '1' , 'id_jenis_level_2' => '1' , 'id_jenis_warganegara' => '1' , 'id_negara_asing' => '1' , 'id_propinsi' => '1' , 'id_propinsi_lain' => '1' , 'id_jenis_status_perkawinan' => '1' , 'id_jenis_kelamin' => '1' , 'id_jenis_kaki' => '1' , 'id_jenis_keahlian_1' => '1' , 'id_jenis_keahlian_1_lain' => '1' , 'id_tempat_lahir' => '1' , 'id_tempat_lahir_lain' => '1' , 'id_kota' => '1' , 'id_kota_lain' => '1' , 'id_tempat_asal' => '1' , 'id_tempat_asal_lain' => '1' , 'residivis' => '1' , 'residivis_counter' => '1' , 'nik' => '1' , 'nama_lengkap' => '1' , 'nama_alias1' => '1' , 'nama_alias2' => '1' , 'nama_alias3' => '1' , 'nama_kecil1' => '1' , 'nama_kecil2' => '1' , 'nama_kecil3' => '1' , 'tanggal_lahir' => '1' , 'is_wbp_beresiko_tinggi' => '1' , 'is_pengaruh_terhadap_masyarakat' => '1' , 'is_baca_latin' => '1' , 'is_baca_quran' => '1' , 'alamat' => '1' , 'alamat_alternatif' => '1' , 'kodepos' => '1' , 'telepon' => '1' , 'alamat_pekerjaan' => '1' , 'keterangan_pekerjaan' => '1' , 'minat' => '1' , 'nm_ayah' => '1' , 'tmp_tgl_ayah' => '1' , 'nm_ibu' => '1' , 'tmp_tgl_ibu' => '1' , 'nm_saudara_ori' => '1' , 'nm_saudara' => '1' , 'anakke' => '1' , 'jml_saudara' => '1' , 'jml_istri_suami' => '1' , 'nm_istri_suami_ori' => '1' , 'nm_istri_suami' => '1' , 'tmp_tgl_istri_suami' => '1' , 'jml_anak' => '1' , 'nm_anak_ori' => '1' , 'nm_anak' => '1' , 'telephone_keluarga' => '1' , 'tinggi' => '1' , 'berat' => '1' , 'cacat' => '1' , 'ciri' => '1' , 'ciri2' => '1' , 'ciri3' => '1' , 'foto_depan' => '1' , 'foto_kanan' => '1' , 'foto_kiri' => '1' , 'foto_ciri_1' => '1' , 'foto_ciri_2' => '1' , 'foto_ciri_3' => '1' , 'konsolidasi' => '1' , 'konsolidasi_image' => '1' , 'id_telinga' => '1' , 'id_kacamata' => '1' , 'id_warnakulit' => '1' , 'id_bentukrambut' => '1' , 'id_bentukbibir' => '1' , 'id_lengan' => '1' , 'id_tingkat_penghasilan' => '1' , 'nomor_induk_nasional' => '1' , 'is_verifikasi' => '1' , 'is_deleted' => '1' , 'created' => '1' , 'updated' => '1' , 'created_by' => '1' , 'created_by_role' => '1' , 'updated_by' => '1' , 'updated_by_role' => '1'
        ];
        $this->json('POST', '/identitas', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowIdentitas()
    {
        $data = factory(Identitas::class)->create();
        $this->json('GET', '/identitas/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateIdentitas()
    {
        $data = factory(Identitas::class)->create();
        $properties = [
                'nomor_induk' => '1' , 'id_jenis_suku' => '1' , 'id_jenis_suku_lain' => '1' , 'id_jenis_rambut' => '1' , 'id_jenis_muka' => '1' , 'id_jenis_pendidikan' => '1' , 'id_jenis_pendidikan_lain' => '1' , 'id_jenis_tangan' => '1' , 'id_jenis_agama' => '1' , 'id_jenis_agama_lain' => '1' , 'id_jenis_pekerjaan' => '1' , 'id_jenis_pekerjaan_lain' => '1' , 'nama_instansi_pns' => '1' , 'nip' => '1' , 'id_user' => '1' , 'id_bentuk_mata' => '1' , 'id_warna_mata' => '1' , 'id_jenis_keahlian_2' => '1' , 'id_jenis_keahlian_2_lain' => '1' , 'id_jenis_hidung' => '1' , 'id_jenis_level_1' => '1' , 'id_jenis_mulut' => '1' , 'id_jenis_level_2' => '1' , 'id_jenis_warganegara' => '1' , 'id_negara_asing' => '1' , 'id_propinsi' => '1' , 'id_propinsi_lain' => '1' , 'id_jenis_status_perkawinan' => '1' , 'id_jenis_kelamin' => '1' , 'id_jenis_kaki' => '1' , 'id_jenis_keahlian_1' => '1' , 'id_jenis_keahlian_1_lain' => '1' , 'id_tempat_lahir' => '1' , 'id_tempat_lahir_lain' => '1' , 'id_kota' => '1' , 'id_kota_lain' => '1' , 'id_tempat_asal' => '1' , 'id_tempat_asal_lain' => '1' , 'residivis' => '1' , 'residivis_counter' => '1' , 'nik' => '1' , 'nama_lengkap' => '1' , 'nama_alias1' => '1' , 'nama_alias2' => '1' , 'nama_alias3' => '1' , 'nama_kecil1' => '1' , 'nama_kecil2' => '1' , 'nama_kecil3' => '1' , 'tanggal_lahir' => '1' , 'is_wbp_beresiko_tinggi' => '1' , 'is_pengaruh_terhadap_masyarakat' => '1' , 'is_baca_latin' => '1' , 'is_baca_quran' => '1' , 'alamat' => '1' , 'alamat_alternatif' => '1' , 'kodepos' => '1' , 'telepon' => '1' , 'alamat_pekerjaan' => '1' , 'keterangan_pekerjaan' => '1' , 'minat' => '1' , 'nm_ayah' => '1' , 'tmp_tgl_ayah' => '1' , 'nm_ibu' => '1' , 'tmp_tgl_ibu' => '1' , 'nm_saudara_ori' => '1' , 'nm_saudara' => '1' , 'anakke' => '1' , 'jml_saudara' => '1' , 'jml_istri_suami' => '1' , 'nm_istri_suami_ori' => '1' , 'nm_istri_suami' => '1' , 'tmp_tgl_istri_suami' => '1' , 'jml_anak' => '1' , 'nm_anak_ori' => '1' , 'nm_anak' => '1' , 'telephone_keluarga' => '1' , 'tinggi' => '1' , 'berat' => '1' , 'cacat' => '1' , 'ciri' => '1' , 'ciri2' => '1' , 'ciri3' => '1' , 'foto_depan' => '1' , 'foto_kanan' => '1' , 'foto_kiri' => '1' , 'foto_ciri_1' => '1' , 'foto_ciri_2' => '1' , 'foto_ciri_3' => '1' , 'konsolidasi' => '1' , 'konsolidasi_image' => '1' , 'id_telinga' => '1' , 'id_kacamata' => '1' , 'id_warnakulit' => '1' , 'id_bentukrambut' => '1' , 'id_bentukbibir' => '1' , 'id_lengan' => '1' , 'id_tingkat_penghasilan' => '1' , 'nomor_induk_nasional' => '1' , 'is_verifikasi' => '1' , 'is_deleted' => '1' , 'created' => '1' , 'updated' => '1' , 'created_by' => '1' , 'created_by_role' => '1' , 'updated_by' => '1' , 'updated_by_role' => '1'
            ];
        $this->json('PATCH', '/identitas/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyIdentitas()
    {
        $data = factory(Identitas::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/identitas', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
