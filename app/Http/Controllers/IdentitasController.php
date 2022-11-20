<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use App\Services\IdentitasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdentitasController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new IdentitasService();
    $this->rules = array(
      'nomor_induk' => 'required',
      'id_jenis_suku' => 'nullable',
      'id_jenis_suku_lain' => 'nullable',
      'id_jenis_rambut' => 'nullable',
      'id_jenis_muka' => 'nullable',
      'id_jenis_pendidikan' => 'nullable',
      'id_jenis_pendidikan_lain' => 'nullable',
      'id_jenis_tangan' => 'nullable',
      'id_jenis_agama' => 'nullable',
      'id_jenis_agama_lain' => 'nullable',
      'id_jenis_pekerjaan' => 'nullable',
      'id_jenis_pekerjaan_lain' => 'nullable',
      'nama_instansi_pns' => 'nullable',
      'nip' => 'nullable',
      'id_user' => 'nullable',
      'id_bentuk_mata' => 'nullable',
      'id_warna_mata' => 'nullable',
      'id_jenis_keahlian_2' => 'nullable',
      'id_jenis_keahlian_2_lain' => 'nullable',
      'id_jenis_hidung' => 'nullable',
      'id_jenis_level_1' => 'nullable',
      'id_jenis_mulut' => 'nullable',
      'id_jenis_level_2' => 'nullable',
      'id_jenis_warganegara' => 'nullable',
      'id_negara_asing' => 'nullable',
      'id_propinsi' => 'nullable',
      'id_propinsi_lain' => 'nullable',
      'id_jenis_status_perkawinan' => 'nullable',
      'id_jenis_kelamin' => 'nullable',
      'id_jenis_kaki' => 'nullable',
      'id_jenis_keahlian_1' => 'nullable',
      'id_jenis_keahlian_1_lain' => 'nullable',
      'id_tempat_lahir' => 'nullable',
      'id_tempat_lahir_lain' => 'nullable',
      'id_kota' => 'nullable',
      'id_kota_lain' => 'nullable',
      'id_tempat_asal' => 'nullable',
      'id_tempat_asal_lain' => 'nullable',
      'residivis' => 'nullable',
      'residivis_counter' => 'nullable',
      'nik' => 'nullable',
      'nama_lengkap' => 'required',
      'nama_alias1' => 'nullable',
      'nama_alias2' => 'nullable',
      'nama_alias3' => 'nullable',
      'nama_kecil1' => 'nullable',
      'nama_kecil2' => 'nullable',
      'nama_kecil3' => 'nullable',
      'tanggal_lahir' => 'nullable',
      'is_wbp_beresiko_tinggi' => 'nullable',
      'is_pengaruh_terhadap_masyarakat' => 'nullable',
      'is_baca_latin' => 'nullable',
      'is_baca_quran' => 'nullable',
      'alamat' => 'nullable',
      'alamat_alternatif' => 'nullable',
      'kodepos' => 'nullable',
      'telepon' => 'nullable',
      'alamat_pekerjaan' => 'nullable',
      'keterangan_pekerjaan' => 'nullable',
      'minat' => 'nullable',
      'nm_ayah' => 'nullable',
      'tmp_tgl_ayah' => 'nullable',
      'nm_ibu' => 'nullable',
      'tmp_tgl_ibu' => 'nullable',
      'nm_saudara_ori' => 'nullable',
      'nm_saudara' => 'nullable',
      'anakke' => 'nullable',
      'jml_saudara' => 'nullable',
      'jml_istri_suami' => 'nullable',
      'nm_istri_suami_ori' => 'nullable',
      'nm_istri_suami' => 'nullable',
      'tmp_tgl_istri_suami' => 'nullable',
      'jml_anak' => 'nullable',
      'nm_anak_ori' => 'nullable',
      'nm_anak' => 'nullable',
      'telephone_keluarga' => 'nullable',
      'tinggi' => 'nullable',
      'berat' => 'nullable',
      'cacat' => 'nullable',
      'ciri' => 'nullable',
      'ciri2' => 'nullable',
      'ciri3' => 'nullable',
      'foto_depan' => 'nullable',
      'foto_kanan' => 'nullable',
      'foto_kiri' => 'nullable',
      'foto_ciri_1' => 'nullable',
      'foto_ciri_2' => 'nullable',
      'foto_ciri_3' => 'nullable',
      'konsolidasi' => 'nullable',
      'konsolidasi_image' => 'nullable',
      'id_telinga' => 'nullable',
      'id_kacamata' => 'nullable',
      'id_warnakulit' => 'nullable',
      'id_bentukrambut' => 'nullable',
      'id_bentukbibir' => 'nullable',
      'id_lengan' => 'nullable',
      'id_tingkat_penghasilan' => 'nullable',
      'nomor_induk_nasional' => 'nullable',
      'is_verifikasi' => 'nullable',
      'created' => 'nullable',
      'created_by' => 'nullable',
      'created_by_role' => 'nullable',
      'updated_by_role' => 'nullable',
    );
  }

  /**
   * @OA\Get(
   *      path="/identitas",
   *      tags={"Identitas"},
   *      summary="List of Identitas",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="nomor_induk:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="nomor_induk,id_jenis_suku,id_jenis_suku_lain,id_jenis_rambut,id_jenis_muka,id_jenis_pendidikan,id_jenis_pendidikan_lain,id_jenis_tangan,id_jenis_agama,id_jenis_agama_lain,id_jenis_pekerjaan,id_jenis_pekerjaan_lain,nama_instansi_pns,nip,id_user,id_bentuk_mata,id_warna_mata,id_jenis_keahlian_2,id_jenis_keahlian_2_lain,id_jenis_hidung,id_jenis_level_1,id_jenis_mulut,id_jenis_level_2,id_jenis_warganegara,id_negara_asing,id_propinsi,id_propinsi_lain,id_jenis_status_perkawinan,id_jenis_kelamin,id_jenis_kaki,id_jenis_keahlian_1,id_jenis_keahlian_1_lain,id_tempat_lahir,id_tempat_lahir_lain,id_kota,id_kota_lain,id_tempat_asal,id_tempat_asal_lain,residivis,residivis_counter,nik,nama_lengkap,nama_alias1,nama_alias2,nama_alias3,nama_kecil1,nama_kecil2,nama_kecil3,tanggal_lahir,is_wbp_beresiko_tinggi,is_pengaruh_terhadap_masyarakat,is_baca_latin,is_baca_quran,alamat,alamat_alternatif,kodepos,telepon,alamat_pekerjaan,keterangan_pekerjaan,minat,nm_ayah,tmp_tgl_ayah,nm_ibu,tmp_tgl_ibu,nm_saudara_ori,nm_saudara,anakke,jml_saudara,jml_istri_suami,nm_istri_suami_ori,nm_istri_suami,tmp_tgl_istri_suami,jml_anak,nm_anak_ori,nm_anak,telephone_keluarga,tinggi,berat,cacat,ciri,ciri2,ciri3,foto_depan,foto_kanan,foto_kiri,foto_ciri_1,foto_ciri_2,foto_ciri_3,konsolidasi,konsolidasi_image,id_telinga,id_kacamata,id_warnakulit,id_bentukrambut,id_bentukbibir,id_lengan,id_tingkat_penghasilan,nomor_induk_nasional,is_verifikasi,created,created_by,created_by_role,updated_by_role"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas data successfully loaded"),
   *          ),
   *      ),
   * )
   */

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = $request->toArray();
    $identitas = $this->service->search($data, $request->url());

    return response()->json($identitas);
  }

  /**
   * @OA\Get(
   *      path="/identitas/dropdown",
   *      tags={"Identitas"},
   *      summary="List of Identitas",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas data successfully loaded"),
   *          ),
   *      ),
   * )
   */

  /**
   * Display a dropdown listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function dropdown(Request $request)
  {
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["nomor_induk"];
    $columns[] = "id";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = Identitas::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $identitas = $data->get();

    return response()->json($identitas);
  }

  /**
   * @OA\Get(
   *      path="/identitas/schema",
   *      tags={"Identitas"},
   *      summary="Schema of Identitas",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas schema successfully loaded"),
   *          ),
   *      ),
   * )
   */

  /**
   * Display scheme of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function schema(Request $request)
  {
    $fields = array(
      0 =>
      array(
        'Field' => 'id',
        'Type' => 'BIGINT()',
        'Null' => 'NO',
        'Key' => 'PRI',
        'Default' => NULL,
        'Extra' => ' UNSIGNED AUTO_INCREMENT',
      ),
      1 =>
      array(
        'Field' => 'nomor_induk',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      2 =>
      array(
        'Field' => 'id_jenis_suku',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      3 =>
      array(
        'Field' => 'id_jenis_suku_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'id_jenis_rambut',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'id_jenis_muka',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'id_jenis_pendidikan',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'id_jenis_pendidikan_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'id_jenis_tangan',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'id_jenis_agama',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'id_jenis_agama_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'id_jenis_pekerjaan',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'id_jenis_pekerjaan_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'nama_instansi_pns',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'nip',
        'Type' => 'VARCHAR(30)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'id_user',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'id_bentuk_mata',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'id_warna_mata',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      18 =>
      array(
        'Field' => 'id_jenis_keahlian_2',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      19 =>
      array(
        'Field' => 'id_jenis_keahlian_2_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      20 =>
      array(
        'Field' => 'id_jenis_hidung',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      21 =>
      array(
        'Field' => 'id_jenis_level_1',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      22 =>
      array(
        'Field' => 'id_jenis_mulut',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      23 =>
      array(
        'Field' => 'id_jenis_level_2',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      24 =>
      array(
        'Field' => 'id_jenis_warganegara',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      25 =>
      array(
        'Field' => 'id_negara_asing',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      26 =>
      array(
        'Field' => 'id_propinsi',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      27 =>
      array(
        'Field' => 'id_propinsi_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      28 =>
      array(
        'Field' => 'id_jenis_status_perkawinan',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      29 =>
      array(
        'Field' => 'id_jenis_kelamin',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      30 =>
      array(
        'Field' => 'id_jenis_kaki',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      31 =>
      array(
        'Field' => 'id_jenis_keahlian_1',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      32 =>
      array(
        'Field' => 'id_jenis_keahlian_1_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      33 =>
      array(
        'Field' => 'id_tempat_lahir',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      34 =>
      array(
        'Field' => 'id_tempat_lahir_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      35 =>
      array(
        'Field' => 'id_kota',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      36 =>
      array(
        'Field' => 'id_kota_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      37 =>
      array(
        'Field' => 'id_tempat_asal',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      38 =>
      array(
        'Field' => 'id_tempat_asal_lain',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      39 =>
      array(
        'Field' => 'residivis',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      40 =>
      array(
        'Field' => 'residivis_counter',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      41 =>
      array(
        'Field' => 'nik',
        'Type' => 'VARCHAR(35)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      42 =>
      array(
        'Field' => 'nama_lengkap',
        'Type' => 'VARCHAR(100)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      43 =>
      array(
        'Field' => 'nama_alias1',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      44 =>
      array(
        'Field' => 'nama_alias2',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      45 =>
      array(
        'Field' => 'nama_alias3',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      46 =>
      array(
        'Field' => 'nama_kecil1',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      47 =>
      array(
        'Field' => 'nama_kecil2',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      48 =>
      array(
        'Field' => 'nama_kecil3',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      49 =>
      array(
        'Field' => 'tanggal_lahir',
        'Type' => 'DATETIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      50 =>
      array(
        'Field' => 'is_wbp_beresiko_tinggi',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      51 =>
      array(
        'Field' => 'is_pengaruh_terhadap_masyarakat',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      52 =>
      array(
        'Field' => 'is_baca_latin',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      53 =>
      array(
        'Field' => 'is_baca_quran',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      54 =>
      array(
        'Field' => 'alamat',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      55 =>
      array(
        'Field' => 'alamat_alternatif',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      56 =>
      array(
        'Field' => 'kodepos',
        'Type' => 'VARCHAR(10)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      57 =>
      array(
        'Field' => 'telepon',
        'Type' => 'VARCHAR(15)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      58 =>
      array(
        'Field' => 'alamat_pekerjaan',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      59 =>
      array(
        'Field' => 'keterangan_pekerjaan',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      60 =>
      array(
        'Field' => 'minat',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      61 =>
      array(
        'Field' => 'nm_ayah',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      62 =>
      array(
        'Field' => 'tmp_tgl_ayah',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      63 =>
      array(
        'Field' => 'nm_ibu',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      64 =>
      array(
        'Field' => 'tmp_tgl_ibu',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      65 =>
      array(
        'Field' => 'nm_saudara_ori',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      66 =>
      array(
        'Field' => 'nm_saudara',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      67 =>
      array(
        'Field' => 'anakke',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      68 =>
      array(
        'Field' => 'jml_saudara',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      69 =>
      array(
        'Field' => 'jml_istri_suami',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      70 =>
      array(
        'Field' => 'nm_istri_suami_ori',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      71 =>
      array(
        'Field' => 'nm_istri_suami',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      72 =>
      array(
        'Field' => 'tmp_tgl_istri_suami',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      73 =>
      array(
        'Field' => 'jml_anak',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      74 =>
      array(
        'Field' => 'nm_anak_ori',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      75 =>
      array(
        'Field' => 'nm_anak',
        'Type' => 'TEXT',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      76 =>
      array(
        'Field' => 'telephone_keluarga',
        'Type' => 'VARCHAR(15)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      77 =>
      array(
        'Field' => 'tinggi',
        'Type' => 'DECIMAL(, 8)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      78 =>
      array(
        'Field' => 'berat',
        'Type' => 'DECIMAL(, 8)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      79 =>
      array(
        'Field' => 'cacat',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      80 =>
      array(
        'Field' => 'ciri',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      81 =>
      array(
        'Field' => 'ciri2',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      82 =>
      array(
        'Field' => 'ciri3',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      83 =>
      array(
        'Field' => 'foto_depan',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      84 =>
      array(
        'Field' => 'foto_kanan',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      85 =>
      array(
        'Field' => 'foto_kiri',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      86 =>
      array(
        'Field' => 'foto_ciri_1',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      87 =>
      array(
        'Field' => 'foto_ciri_2',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      88 =>
      array(
        'Field' => 'foto_ciri_3',
        'Type' => 'VARCHAR(150)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      89 =>
      array(
        'Field' => 'konsolidasi',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      90 =>
      array(
        'Field' => 'konsolidasi_image',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      91 =>
      array(
        'Field' => 'id_telinga',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      92 =>
      array(
        'Field' => 'id_kacamata',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      93 =>
      array(
        'Field' => 'id_warnakulit',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      94 =>
      array(
        'Field' => 'id_bentukrambut',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      95 =>
      array(
        'Field' => 'id_bentukbibir',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      96 =>
      array(
        'Field' => 'id_lengan',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      97 =>
      array(
        'Field' => 'id_tingkat_penghasilan',
        'Type' => 'VARCHAR(4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      98 =>
      array(
        'Field' => 'nomor_induk_nasional',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      99 =>
      array(
        'Field' => 'is_verifikasi',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      100 =>
      array(
        'Field' => 'is_deleted',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      101 =>
      array(
        'Field' => 'created',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      102 =>
      array(
        'Field' => 'updated',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      103 =>
      array(
        'Field' => 'created_by',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      104 =>
      array(
        'Field' => 'created_by_role',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      105 =>
      array(
        'Field' => 'updated_by',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      106 =>
      array(
        'Field' => 'updated_by_role',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      107 =>
      array(
        'Field' => 'deleted_at',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      108 =>
      array(
        'Field' => 'created_at',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      109 =>
      array(
        'Field' => 'updated_at',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
    );
    $schema = array(
      'name' => 'identitas',
      'module' => 'lain-lain',
      'primary_key' => 'id',
      'api' => [
        'endpoint' => 'pembinaan-kepribadian',
        'url' => '/identitas'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/identitas/{id}",
   *      tags={"Identitas"},
   *      summary="Identitas details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Identitas ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $identitas = Identitas::where('id', $id)->firstOrFail();
    if (!$identitas->exists) {
      return response()->json([
        'status' => 500,
        'message' => "Identitas tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($identitas);
    //$collection = collect($identitas);
    //$merge = $collection->merge($data);    
    return response()->json([
      'status' => 200,
      'message' => "Identitas ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/identitas",
   *      tags={"Create Identitas"},
   *      summary="Create Identitas",
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="nomor_induk", ref="#/components/schemas/Identitas/properties/nomor_induk"),
   *              @OA\Property(property="nama_lengkap", ref="#/components/schemas/Identitas/properties/nama_lengkap"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas successfully created"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="nomor_induk", type="array", @OA\Items(example={"Nomor_induk field is required."})),
   *              @OA\Property(property="nama_lengkap", type="array", @OA\Items(example={"Nama_lengkap field is required."}))
   *          ),
   *      ),
   * )
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
$this->validate($request, $this->rules);


    $identitas = Identitas::create($request->all());
    if ($identitas->exists) {
      return response()->json([
        'status' => 200,
        'message' => "Identitas berhasil ditambahkan.",
        'data' => $identitas
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Identitas tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/identitas/{id}",
   *      tags={"Identitas"},
   *      summary="Update Identitas",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Identitas ID"),
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="nomor_induk", ref="#/components/schemas/Identitas/properties/nomor_induk"),
   *              @OA\Property(property="nama_lengkap", ref="#/components/schemas/Identitas/properties/nama_lengkap"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas successfully updated"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="nomor_induk", type="array", @OA\Items(example={"Nomor_induk field is required."})),
   *              @OA\Property(property="nama_lengkap", type="array", @OA\Items(example={"Nama_lengkap field is required."}))
   *          ),
   *      ),
   * )
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
$this->validate($request, $this->rules);


    $identitas = Identitas::where('id', $id)->firstOrFail();
    if ($identitas->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "Identitas berhasil diubah.",
        'data' => $identitas
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Identitas tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/identitas/{id}",
   *      tags={"Identitas"},
   *      summary="Identitas Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Identitas ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Identitas deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $identitas = Identitas::where('id', $id)->firstOrFail();

    if ($identitas->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "Identitas berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Identitas tidak dapat dihapus.",
        'data' => null
      ]);
    }
  }
}
