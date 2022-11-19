<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Identitas
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Identitas"),
 *      description="Identitas Model",
 *      type="object",
 *      title="Identitas Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="nomor_induk", type="string"),
     *      @OA\Property(property="id_jenis_suku", type="string"),
     *      @OA\Property(property="id_jenis_suku_lain", type="string"),
     *      @OA\Property(property="id_jenis_rambut", type="string"),
     *      @OA\Property(property="id_jenis_muka", type="string"),
     *      @OA\Property(property="id_jenis_pendidikan", type="string"),
     *      @OA\Property(property="id_jenis_pendidikan_lain", type="string"),
     *      @OA\Property(property="id_jenis_tangan", type="string"),
     *      @OA\Property(property="id_jenis_agama", type="string"),
     *      @OA\Property(property="id_jenis_agama_lain", type="string"),
     *      @OA\Property(property="id_jenis_pekerjaan", type="string"),
     *      @OA\Property(property="id_jenis_pekerjaan_lain", type="string"),
     *      @OA\Property(property="nama_instansi_pns", type="string"),
     *      @OA\Property(property="nip", type="string"),
     *      @OA\Property(property="id_user", type="string"),
     *      @OA\Property(property="id_bentuk_mata", type="string"),
     *      @OA\Property(property="id_warna_mata", type="string"),
     *      @OA\Property(property="id_jenis_keahlian_2", type="string"),
     *      @OA\Property(property="id_jenis_keahlian_2_lain", type="string"),
     *      @OA\Property(property="id_jenis_hidung", type="string"),
     *      @OA\Property(property="id_jenis_level_1", type="string"),
     *      @OA\Property(property="id_jenis_mulut", type="string"),
     *      @OA\Property(property="id_jenis_level_2", type="string"),
     *      @OA\Property(property="id_jenis_warganegara", type="string"),
     *      @OA\Property(property="id_negara_asing", type="string"),
     *      @OA\Property(property="id_propinsi", type="string"),
     *      @OA\Property(property="id_propinsi_lain", type="string"),
     *      @OA\Property(property="id_jenis_status_perkawinan", type="string"),
     *      @OA\Property(property="id_jenis_kelamin", type="string"),
     *      @OA\Property(property="id_jenis_kaki", type="string"),
     *      @OA\Property(property="id_jenis_keahlian_1", type="string"),
     *      @OA\Property(property="id_jenis_keahlian_1_lain", type="string"),
     *      @OA\Property(property="id_tempat_lahir", type="string"),
     *      @OA\Property(property="id_tempat_lahir_lain", type="string"),
     *      @OA\Property(property="id_kota", type="string"),
     *      @OA\Property(property="id_kota_lain", type="string"),
     *      @OA\Property(property="id_tempat_asal", type="string"),
     *      @OA\Property(property="id_tempat_asal_lain", type="string"),
     *      @OA\Property(property="residivis", type="string"),
     *      @OA\Property(property="residivis_counter", type="boolean"),
     *      @OA\Property(property="nik", type="string"),
     *      @OA\Property(property="nama_lengkap", type="string"),
     *      @OA\Property(property="nama_alias1", type="string"),
     *      @OA\Property(property="nama_alias2", type="string"),
     *      @OA\Property(property="nama_alias3", type="string"),
     *      @OA\Property(property="nama_kecil1", type="string"),
     *      @OA\Property(property="nama_kecil2", type="string"),
     *      @OA\Property(property="nama_kecil3", type="string"),
     *      @OA\Property(property="tanggal_lahir", type="date"),
     *      @OA\Property(property="is_wbp_beresiko_tinggi", type="boolean"),
     *      @OA\Property(property="is_pengaruh_terhadap_masyarakat", type="boolean"),
     *      @OA\Property(property="is_baca_latin", type="boolean"),
     *      @OA\Property(property="is_baca_quran", type="boolean"),
     *      @OA\Property(property="alamat", type="text"),
     *      @OA\Property(property="alamat_alternatif", type="text"),
     *      @OA\Property(property="kodepos", type="string"),
     *      @OA\Property(property="telepon", type="string"),
     *      @OA\Property(property="alamat_pekerjaan", type="string"),
     *      @OA\Property(property="keterangan_pekerjaan", type="string"),
     *      @OA\Property(property="minat", type="string"),
     *      @OA\Property(property="nm_ayah", type="string"),
     *      @OA\Property(property="tmp_tgl_ayah", type="string"),
     *      @OA\Property(property="nm_ibu", type="string"),
     *      @OA\Property(property="tmp_tgl_ibu", type="string"),
     *      @OA\Property(property="nm_saudara_ori", type="text"),
     *      @OA\Property(property="nm_saudara", type="text"),
     *      @OA\Property(property="anakke", type="integer"),
     *      @OA\Property(property="jml_saudara", type="integer"),
     *      @OA\Property(property="jml_istri_suami", type="integer"),
     *      @OA\Property(property="nm_istri_suami_ori", type="text"),
     *      @OA\Property(property="nm_istri_suami", type="text"),
     *      @OA\Property(property="tmp_tgl_istri_suami", type="string"),
     *      @OA\Property(property="jml_anak", type="integer"),
     *      @OA\Property(property="nm_anak_ori", type="text"),
     *      @OA\Property(property="nm_anak", type="text"),
     *      @OA\Property(property="telephone_keluarga", type="string"),
     *      @OA\Property(property="tinggi", type="float"),
     *      @OA\Property(property="berat", type="float"),
     *      @OA\Property(property="cacat", type="string"),
     *      @OA\Property(property="ciri", type="string"),
     *      @OA\Property(property="ciri2", type="string"),
     *      @OA\Property(property="ciri3", type="string"),
     *      @OA\Property(property="foto_depan", type="string"),
     *      @OA\Property(property="foto_kanan", type="string"),
     *      @OA\Property(property="foto_kiri", type="string"),
     *      @OA\Property(property="foto_ciri_1", type="string"),
     *      @OA\Property(property="foto_ciri_2", type="string"),
     *      @OA\Property(property="foto_ciri_3", type="string"),
     *      @OA\Property(property="konsolidasi", type="boolean"),
     *      @OA\Property(property="konsolidasi_image", type="boolean"),
     *      @OA\Property(property="id_telinga", type="string"),
     *      @OA\Property(property="id_kacamata", type="string"),
     *      @OA\Property(property="id_warnakulit", type="string"),
     *      @OA\Property(property="id_bentukrambut", type="string"),
     *      @OA\Property(property="id_bentukbibir", type="string"),
     *      @OA\Property(property="id_lengan", type="string"),
     *      @OA\Property(property="id_tingkat_penghasilan", type="string"),
     *      @OA\Property(property="nomor_induk_nasional", type="string"),
     *      @OA\Property(property="is_verifikasi", type="boolean"),
     *      @OA\Property(property="is_deleted", type="boolean"),
     *      @OA\Property(property="created", type="datetime"),
     *      @OA\Property(property="updated", type="datetime"),
     *      @OA\Property(property="created_by", type="string"),
     *      @OA\Property(property="created_by_role", type="string"),
     *      @OA\Property(property="updated_by", type="string"),
     *      @OA\Property(property="updated_by_role", type="string"),
     *      @OA\Property(property="deleted_at", type="datetime"),
     *      @OA\Property(property="created_at", type="datetime"),
     *      @OA\Property(property="updated_at", type="datetime"),
 * )
 * @property int id
     * @property bigint id
     * @property string nomor_induk
     * @property string id_jenis_suku
     * @property string id_jenis_suku_lain
     * @property string id_jenis_rambut
     * @property string id_jenis_muka
     * @property string id_jenis_pendidikan
     * @property string id_jenis_pendidikan_lain
     * @property string id_jenis_tangan
     * @property string id_jenis_agama
     * @property string id_jenis_agama_lain
     * @property string id_jenis_pekerjaan
     * @property string id_jenis_pekerjaan_lain
     * @property string nama_instansi_pns
     * @property string nip
     * @property string id_user
     * @property string id_bentuk_mata
     * @property string id_warna_mata
     * @property string id_jenis_keahlian_2
     * @property string id_jenis_keahlian_2_lain
     * @property string id_jenis_hidung
     * @property string id_jenis_level_1
     * @property string id_jenis_mulut
     * @property string id_jenis_level_2
     * @property string id_jenis_warganegara
     * @property string id_negara_asing
     * @property string id_propinsi
     * @property string id_propinsi_lain
     * @property string id_jenis_status_perkawinan
     * @property string id_jenis_kelamin
     * @property string id_jenis_kaki
     * @property string id_jenis_keahlian_1
     * @property string id_jenis_keahlian_1_lain
     * @property string id_tempat_lahir
     * @property string id_tempat_lahir_lain
     * @property string id_kota
     * @property string id_kota_lain
     * @property string id_tempat_asal
     * @property string id_tempat_asal_lain
     * @property string residivis
     * @property boolean residivis_counter
     * @property string nik
     * @property string nama_lengkap
     * @property string nama_alias1
     * @property string nama_alias2
     * @property string nama_alias3
     * @property string nama_kecil1
     * @property string nama_kecil2
     * @property string nama_kecil3
     * @property date tanggal_lahir
     * @property boolean is_wbp_beresiko_tinggi
     * @property boolean is_pengaruh_terhadap_masyarakat
     * @property boolean is_baca_latin
     * @property boolean is_baca_quran
     * @property text alamat
     * @property text alamat_alternatif
     * @property string kodepos
     * @property string telepon
     * @property string alamat_pekerjaan
     * @property string keterangan_pekerjaan
     * @property string minat
     * @property string nm_ayah
     * @property string tmp_tgl_ayah
     * @property string nm_ibu
     * @property string tmp_tgl_ibu
     * @property text nm_saudara_ori
     * @property text nm_saudara
     * @property integer anakke
     * @property integer jml_saudara
     * @property integer jml_istri_suami
     * @property text nm_istri_suami_ori
     * @property text nm_istri_suami
     * @property string tmp_tgl_istri_suami
     * @property integer jml_anak
     * @property text nm_anak_ori
     * @property text nm_anak
     * @property string telephone_keluarga
     * @property float tinggi
     * @property float berat
     * @property string cacat
     * @property string ciri
     * @property string ciri2
     * @property string ciri3
     * @property string foto_depan
     * @property string foto_kanan
     * @property string foto_kiri
     * @property string foto_ciri_1
     * @property string foto_ciri_2
     * @property string foto_ciri_3
     * @property boolean konsolidasi
     * @property boolean konsolidasi_image
     * @property string id_telinga
     * @property string id_kacamata
     * @property string id_warnakulit
     * @property string id_bentukrambut
     * @property string id_bentukbibir
     * @property string id_lengan
     * @property string id_tingkat_penghasilan
     * @property string nomor_induk_nasional
     * @property boolean is_verifikasi
     * @property boolean is_deleted
     * @property datetime created
     * @property datetime updated
     * @property string created_by
     * @property string created_by_role
     * @property string updated_by
     * @property string updated_by_role
     * @property datetime deleted_at
     * @property datetime created_at
     * @property datetime updated_at
 */
class Identitas extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "identitas";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'nomor_induk' ,'id_jenis_suku' ,'id_jenis_suku_lain' ,'id_jenis_rambut' ,'id_jenis_muka' ,'id_jenis_pendidikan' ,'id_jenis_pendidikan_lain' ,'id_jenis_tangan' ,'id_jenis_agama' ,'id_jenis_agama_lain' ,'id_jenis_pekerjaan' ,'id_jenis_pekerjaan_lain' ,'nama_instansi_pns' ,'nip' ,'id_user' ,'id_bentuk_mata' ,'id_warna_mata' ,'id_jenis_keahlian_2' ,'id_jenis_keahlian_2_lain' ,'id_jenis_hidung' ,'id_jenis_level_1' ,'id_jenis_mulut' ,'id_jenis_level_2' ,'id_jenis_warganegara' ,'id_negara_asing' ,'id_propinsi' ,'id_propinsi_lain' ,'id_jenis_status_perkawinan' ,'id_jenis_kelamin' ,'id_jenis_kaki' ,'id_jenis_keahlian_1' ,'id_jenis_keahlian_1_lain' ,'id_tempat_lahir' ,'id_tempat_lahir_lain' ,'id_kota' ,'id_kota_lain' ,'id_tempat_asal' ,'id_tempat_asal_lain' ,'residivis' ,'residivis_counter' ,'nik' ,'nama_lengkap' ,'nama_alias1' ,'nama_alias2' ,'nama_alias3' ,'nama_kecil1' ,'nama_kecil2' ,'nama_kecil3' ,'tanggal_lahir' ,'is_wbp_beresiko_tinggi' ,'is_pengaruh_terhadap_masyarakat' ,'is_baca_latin' ,'is_baca_quran' ,'alamat' ,'alamat_alternatif' ,'kodepos' ,'telepon' ,'alamat_pekerjaan' ,'keterangan_pekerjaan' ,'minat' ,'nm_ayah' ,'tmp_tgl_ayah' ,'nm_ibu' ,'tmp_tgl_ibu' ,'nm_saudara_ori' ,'nm_saudara' ,'anakke' ,'jml_saudara' ,'jml_istri_suami' ,'nm_istri_suami_ori' ,'nm_istri_suami' ,'tmp_tgl_istri_suami' ,'jml_anak' ,'nm_anak_ori' ,'nm_anak' ,'telephone_keluarga' ,'tinggi' ,'berat' ,'cacat' ,'ciri' ,'ciri2' ,'ciri3' ,'foto_depan' ,'foto_kanan' ,'foto_kiri' ,'foto_ciri_1' ,'foto_ciri_2' ,'foto_ciri_3' ,'konsolidasi' ,'konsolidasi_image' ,'id_telinga' ,'id_kacamata' ,'id_warnakulit' ,'id_bentukrambut' ,'id_bentukbibir' ,'id_lengan' ,'id_tingkat_penghasilan' ,'nomor_induk_nasional' ,'is_verifikasi' ,'is_deleted' ,'created' ,'updated' ,'created_by' ,'created_by_role' ,'updated_by' ,'updated_by_role'
    ];

    protected $orderable = [
        'nomor_induk' ,'id_jenis_suku' ,'id_jenis_suku_lain' ,'id_jenis_rambut' ,'id_jenis_muka' ,'id_jenis_pendidikan' ,'id_jenis_pendidikan_lain' ,'id_jenis_tangan' ,'id_jenis_agama' ,'id_jenis_agama_lain' ,'id_jenis_pekerjaan' ,'id_jenis_pekerjaan_lain' ,'nama_instansi_pns' ,'nip' ,'id_user' ,'id_bentuk_mata' ,'id_warna_mata' ,'id_jenis_keahlian_2' ,'id_jenis_keahlian_2_lain' ,'id_jenis_hidung' ,'id_jenis_level_1' ,'id_jenis_mulut' ,'id_jenis_level_2' ,'id_jenis_warganegara' ,'id_negara_asing' ,'id_propinsi' ,'id_propinsi_lain' ,'id_jenis_status_perkawinan' ,'id_jenis_kelamin' ,'id_jenis_kaki' ,'id_jenis_keahlian_1' ,'id_jenis_keahlian_1_lain' ,'id_tempat_lahir' ,'id_tempat_lahir_lain' ,'id_kota' ,'id_kota_lain' ,'id_tempat_asal' ,'id_tempat_asal_lain' ,'residivis' ,'residivis_counter' ,'nik' ,'nama_lengkap' ,'nama_alias1' ,'nama_alias2' ,'nama_alias3' ,'nama_kecil1' ,'nama_kecil2' ,'nama_kecil3' ,'tanggal_lahir' ,'is_wbp_beresiko_tinggi' ,'is_pengaruh_terhadap_masyarakat' ,'is_baca_latin' ,'is_baca_quran' ,'alamat' ,'alamat_alternatif' ,'kodepos' ,'telepon' ,'alamat_pekerjaan' ,'keterangan_pekerjaan' ,'minat' ,'nm_ayah' ,'tmp_tgl_ayah' ,'nm_ibu' ,'tmp_tgl_ibu' ,'nm_saudara_ori' ,'nm_saudara' ,'anakke' ,'jml_saudara' ,'jml_istri_suami' ,'nm_istri_suami_ori' ,'nm_istri_suami' ,'tmp_tgl_istri_suami' ,'jml_anak' ,'nm_anak_ori' ,'nm_anak' ,'telephone_keluarga' ,'tinggi' ,'berat' ,'cacat' ,'ciri' ,'ciri2' ,'ciri3' ,'foto_depan' ,'foto_kanan' ,'foto_kiri' ,'foto_ciri_1' ,'foto_ciri_2' ,'foto_ciri_3' ,'konsolidasi' ,'konsolidasi_image' ,'id_telinga' ,'id_kacamata' ,'id_warnakulit' ,'id_bentukrambut' ,'id_bentukbibir' ,'id_lengan' ,'id_tingkat_penghasilan' ,'nomor_induk_nasional' ,'is_verifikasi' ,'is_deleted' ,'created' ,'updated' ,'created_by' ,'created_by_role' ,'updated_by' ,'updated_by_role'
    ];

    protected $searchable = [
        'nomor_induk' ,'id_jenis_suku' ,'id_jenis_suku_lain' ,'id_jenis_rambut' ,'id_jenis_muka' ,'id_jenis_pendidikan' ,'id_jenis_pendidikan_lain' ,'id_jenis_tangan' ,'id_jenis_agama' ,'id_jenis_agama_lain' ,'id_jenis_pekerjaan' ,'id_jenis_pekerjaan_lain' ,'nama_instansi_pns' ,'nip' ,'id_user' ,'id_bentuk_mata' ,'id_warna_mata' ,'id_jenis_keahlian_2' ,'id_jenis_keahlian_2_lain' ,'id_jenis_hidung' ,'id_jenis_level_1' ,'id_jenis_mulut' ,'id_jenis_level_2' ,'id_jenis_warganegara' ,'id_negara_asing' ,'id_propinsi' ,'id_propinsi_lain' ,'id_jenis_status_perkawinan' ,'id_jenis_kelamin' ,'id_jenis_kaki' ,'id_jenis_keahlian_1' ,'id_jenis_keahlian_1_lain' ,'id_tempat_lahir' ,'id_tempat_lahir_lain' ,'id_kota' ,'id_kota_lain' ,'id_tempat_asal' ,'id_tempat_asal_lain' ,'residivis' ,'residivis_counter' ,'nik' ,'nama_lengkap' ,'nama_alias1' ,'nama_alias2' ,'nama_alias3' ,'nama_kecil1' ,'nama_kecil2' ,'nama_kecil3' ,'tanggal_lahir' ,'is_wbp_beresiko_tinggi' ,'is_pengaruh_terhadap_masyarakat' ,'is_baca_latin' ,'is_baca_quran' ,'alamat' ,'alamat_alternatif' ,'kodepos' ,'telepon' ,'alamat_pekerjaan' ,'keterangan_pekerjaan' ,'minat' ,'nm_ayah' ,'tmp_tgl_ayah' ,'nm_ibu' ,'tmp_tgl_ibu' ,'nm_saudara_ori' ,'nm_saudara' ,'anakke' ,'jml_saudara' ,'jml_istri_suami' ,'nm_istri_suami_ori' ,'nm_istri_suami' ,'tmp_tgl_istri_suami' ,'jml_anak' ,'nm_anak_ori' ,'nm_anak' ,'telephone_keluarga' ,'tinggi' ,'berat' ,'cacat' ,'ciri' ,'ciri2' ,'ciri3' ,'foto_depan' ,'foto_kanan' ,'foto_kiri' ,'foto_ciri_1' ,'foto_ciri_2' ,'foto_ciri_3' ,'konsolidasi' ,'konsolidasi_image' ,'id_telinga' ,'id_kacamata' ,'id_warnakulit' ,'id_bentukrambut' ,'id_bentukbibir' ,'id_lengan' ,'id_tingkat_penghasilan' ,'nomor_induk_nasional' ,'is_verifikasi' ,'is_deleted' ,'created' ,'updated' ,'created_by' ,'created_by_role' ,'updated_by' ,'updated_by_role'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id;
    }

    /**
     * get primary key name
     *
     * @var string
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }
}
