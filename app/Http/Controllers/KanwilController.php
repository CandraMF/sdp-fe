<?php

namespace App\Http\Controllers;

use App\Models\Kanwil;
use App\Services\KanwilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KanwilController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new KanwilService();
    $this->rules = array(
      'uraian' => 'nullable',
      'sdp_ada' => 'nullable',
      'alamat' => 'nullable',
      'telpon' => 'nullable',
      'fax' => 'nullable',
      'kepala_kanwil' => 'nullable',
      'jabatan_kw' => 'nullable',
      'pangkat_kw' => 'nullable',
      'nip_kw' => 'nullable',
      'pejabat_kanwil' => 'nullable',
      'jabatan_pw' => 'nullable',
      'pangkat_pw' => 'nullable',
      'nip_pw' => 'nullable',
      'ip' => 'nullable',
      'login' => 'nullable',
      'password' => 'nullable',
      'id_provinsi' => 'nullable',
      'id_dati2' => 'nullable',
      'email' => 'nullable',
      'website' => 'nullable',
      'konsolidasi' => 'nullable',
      'is_konsolidasi_offline' => 'nullable',
      'nama_aplikasi' => 'nullable',
      'pin' => 'nullable',
      'id_timezone' => 'nullable',
      'versions' => 'nullable',
      'versions_date' => 'nullable',
      'backup_scheduler' => 'nullable',
      'lap_reg_scheduler' => 'nullable',
      'konsolidasi_scheduler' => 'nullable',
      'konsolidasi_scheduler_interval' => 'nullable',
      'konsolidasi_integrasi_scheduler' => 'nullable',
      'terima_data_integrasi_scheduler' => 'nullable',
      'terima_data_integrasi_scheduler_interval' => 'nullable',
      'increament_backup_number' => 'nullable',
      'increament_backup_time' => 'nullable',
    );
  }

  /**
   * @OA\Get(
   *      path="/kanwil",
   *      tags={"Kanwil"},
   *      summary="List of Kanwil",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="kode:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="uraian,sdp_ada,alamat,telpon,fax,kepala_kanwil,jabatan_kw,pangkat_kw,nip_kw,pejabat_kanwil,jabatan_pw,pangkat_pw,nip_pw,ip,login,password,id_provinsi,id_dati2,email,website,konsolidasi,is_konsolidasi_offline,nama_aplikasi,pin,id_timezone,versions,versions_date,backup_scheduler,lap_reg_scheduler,konsolidasi_scheduler,konsolidasi_scheduler_interval,konsolidasi_integrasi_scheduler,terima_data_integrasi_scheduler,terima_data_integrasi_scheduler_interval,increament_backup_number,increament_backup_time"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil data successfully loaded"),
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
    $kanwil = $this->service->search($data, $request->url());

    return response()->json($kanwil);
  }

  /**
   * @OA\Get(
   *      path="/kanwil/dropdown",
   *      tags={"Kanwil"},
   *      summary="List of Kanwil",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil data successfully loaded"),
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
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["kode"];
    $columns[] = "kode";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = Kanwil::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $kanwil = $data->get();

    return response()->json($kanwil);
  }

  /**
   * @OA\Get(
   *      path="/kanwil/schema",
   *      tags={"Kanwil"},
   *      summary="Schema of Kanwil",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil schema successfully loaded"),
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
        'Field' => 'kode',
        'Type' => 'BIGINT()',
        'Null' => 'NO',
        'Key' => 'PRI',
        'Default' => NULL,
        'Extra' => ' UNSIGNED AUTO_INCREMENT',
      ),
      1 =>
      array(
        'Field' => 'uraian',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      2 =>
      array(
        'Field' => 'sdp_ada',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      3 =>
      array(
        'Field' => 'alamat',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'telpon',
        'Type' => 'VARCHAR(20)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'fax',
        'Type' => 'VARCHAR(20)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'kepala_kanwil',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'jabatan_kw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'pangkat_kw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'nip_kw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'pejabat_kanwil',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'jabatan_pw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'pangkat_pw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'nip_pw',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'ip',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'login',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'password',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'id_provinsi',
        'Type' => 'VARCHAR(35)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      18 =>
      array(
        'Field' => 'id_dati2',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      19 =>
      array(
        'Field' => 'status_download',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      20 =>
      array(
        'Field' => 'email',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      21 =>
      array(
        'Field' => 'website',
        'Type' => 'VARCHAR(100)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      22 =>
      array(
        'Field' => 'konsolidasi',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      23 =>
      array(
        'Field' => 'is_konsolidasi_offline',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      24 =>
      array(
        'Field' => 'nama_aplikasi',
        'Type' => 'VARCHAR(20)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      25 =>
      array(
        'Field' => 'pin',
        'Type' => 'VARCHAR(10)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      26 =>
      array(
        'Field' => 'id_timezone',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      27 =>
      array(
        'Field' => 'versions',
        'Type' => 'VARCHAR(10)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      28 =>
      array(
        'Field' => 'versions_date',
        'Type' => 'DATETIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      29 =>
      array(
        'Field' => 'backup_scheduler',
        'Type' => 'TIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      30 =>
      array(
        'Field' => 'lap_reg_scheduler',
        'Type' => 'TIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      31 =>
      array(
        'Field' => 'konsolidasi_scheduler',
        'Type' => 'TIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      32 =>
      array(
        'Field' => 'konsolidasi_scheduler_interval',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      33 =>
      array(
        'Field' => 'konsolidasi_integrasi_scheduler',
        'Type' => 'TIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      34 =>
      array(
        'Field' => 'terima_data_integrasi_scheduler',
        'Type' => 'TIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      35 =>
      array(
        'Field' => 'terima_data_integrasi_scheduler_interval',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      36 =>
      array(
        'Field' => 'increament_backup_number',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => '0',
        'Extra' => '',
      ),
      37 =>
      array(
        'Field' => 'increament_backup_time',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
    );
    $schema = array(
      'name' => 'kanwil',
      'module' => 'lain-lain',
      'primary_key' => 'kode',
      'api' => [
        'endpoint' => 'pembinaan-kepribadian',
        'url' => '/kanwil'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/kanwil/{id}",
   *      tags={"Kanwil"},
   *      summary="Kanwil details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Kanwil ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $kanwil = Kanwil::where('kode', $id)->firstOrFail();
    if (!$kanwil->exists) {
      return response()->json([
        'status' => 500,
        'message' => "Kanwil tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($kanwil);
    //$collection = collect($kanwil);
    //$merge = $collection->merge($data);    
    return response()->json([
      'status' => 200,
      'message' => "Kanwil ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/kanwil",
   *      tags={"Create Kanwil"},
   *      summary="Create Kanwil",
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
     
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil successfully created"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
     
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


    $kanwil = Kanwil::create($request->all());
    if ($kanwil->exists) {
      return response()->json([
        'status' => 200,
        'message' => "Kanwil berhasil ditambahkan.",
        'data' => $kanwil
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Kanwil tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/kanwil/{id}",
   *      tags={"Kanwil"},
   *      summary="Update Kanwil",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Kanwil ID"),
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
     
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil successfully updated"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
     
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


    $kanwil = Kanwil::where('kode', $id)->firstOrFail();
    if ($kanwil->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "Kanwil berhasil diubah.",
        'data' => $kanwil
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Kanwil tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/kanwil/{id}",
   *      tags={"Kanwil"},
   *      summary="Kanwil Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Kanwil ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="Kanwil deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $kanwil = Kanwil::where('kode', $id)->firstOrFail();

    if ($kanwil->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "Kanwil berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "Kanwil tidak dapat dihapus.",
        'data' => null
      ]);
    }
  }
}
