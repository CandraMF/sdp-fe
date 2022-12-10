<?php

namespace App\Http\Controllers;

use App\Models\LaporanPembinaanKepribadian;
use App\Services\LaporanPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPembinaanKepribadianController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new LaporanPembinaanKepribadianService();
    $this->rules = array(
      'id_pembinaan_kepribadian' => 'required',
      'id_upt' => 'required',
      'periode' => 'required',
      'jumlah_hari' => 'required',
      'jumlah_pembinaan_kepribadian' => 'required',
      'jumlah_peserta' => 'required',
      'jumlah_instruktur_petugas' => 'required',
      'jumlah_instruktur_napi' => 'required',
      'jumlah_instruktur_instansi_lain' => 'required',
      'jumlah_instruktur_mitra' => 'required',
      'keterangan' => 'nullable',
      'status' => 'required',
      'verifikasi_upt' => 'required',
      'verifikasi_kanwil' => 'required',
      'verifikasi_ditjen' => 'required',
    );
  }

  /**
   * @OA\Get(
   *      path="/laporanpembinaankepribadian",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="List of LaporanPembinaanKepribadian",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_pembinaan_kepribadian:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_pembinaan_kepribadian,id_upt,periode,jumlah_hari,jumlah_pembinaan_kepribadian,jumlah_peserta,jumlah_instruktur_petugas,jumlah_instruktur_napi,jumlah_instruktur_instansi_lain,jumlah_instruktur_mitra,keterangan,status,verifikasi_upt,verifikasi_kanwil,verifikasi_ditjen"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian data successfully loaded"),
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
    $laporanpembinaankepribadian = $this->service->search($data, $request->url());

    return response()->json($laporanpembinaankepribadian);
  }

  /**
   * @OA\Get(
   *      path="/laporanpembinaankepribadian/dropdown",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="List of LaporanPembinaanKepribadian",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian data successfully loaded"),
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
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_pembinaan_kepribadian"];
    $columns[] = "id";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = LaporanPembinaanKepribadian::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $laporanpembinaankepribadian = $data->get();

    return response()->json($laporanpembinaankepribadian);
  }

  /**
   * @OA\Get(
   *      path="/laporanpembinaankepribadian/schema",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="Schema of LaporanPembinaanKepribadian",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian schema successfully loaded"),
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
        'Field' => 'id_pembinaan_kepribadian',
        'Type' => 'INT()',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      2 =>
      array(
        'Field' => 'id_upt',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      3 =>
      array(
        'Field' => 'periode',
        'Type' => 'DATETIME',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'jumlah_hari',
        'Type' => 'DECIMAL(, 2)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'jumlah_pembinaan_kepribadian',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'jumlah_peserta',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'jumlah_instruktur_petugas',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'jumlah_instruktur_napi',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'jumlah_instruktur_instansi_lain',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'jumlah_instruktur_mitra',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'keterangan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'status',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'verifikasi_upt',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'verifikasi_kanwil',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'verifikasi_ditjen',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'updated_at',
        'Type' => 'TIMESTAMP',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'updated_by',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
    );
    $schema = array(
      'name' => 'laporanpembinaankepribadian',
      'module' => 'lain-lain',
      'primary_key' => 'id',
      'api' => [
        'endpoint' => 'pembinaan-kepribadian',
        'url' => '/laporanpembinaankepribadian'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/laporanpembinaankepribadian/{id}",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="LaporanPembinaanKepribadian details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="LaporanPembinaanKepribadian ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id', $id)->firstOrFail();
    if (!$laporanpembinaankepribadian->exists) {
      return response()->json([
        'status' => 500,
        'message' => "LaporanPembinaanKepribadian tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($laporanpembinaankepribadian);
    //$collection = collect($laporanpembinaankepribadian);
    //$merge = $collection->merge($data);    
    return response()->json([
      'status' => 200,
      'message' => "LaporanPembinaanKepribadian ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/laporanpembinaankepribadian",
   *      tags={"Create LaporanPembinaanKepribadian"},
   *      summary="Create LaporanPembinaanKepribadian",
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
   *              @OA\Property(property="id_upt", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/id_upt"),
   *              @OA\Property(property="periode", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/periode"),
   *              @OA\Property(property="jumlah_hari", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_hari"),
   *              @OA\Property(property="jumlah_pembinaan_kepribadian", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_pembinaan_kepribadian"),
   *              @OA\Property(property="jumlah_peserta", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_peserta"),
   *              @OA\Property(property="jumlah_instruktur_petugas", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_petugas"),
   *              @OA\Property(property="jumlah_instruktur_napi", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_napi"),
   *              @OA\Property(property="jumlah_instruktur_instansi_lain", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_instansi_lain"),
   *              @OA\Property(property="jumlah_instruktur_mitra", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_mitra"),
   *              @OA\Property(property="keterangan", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/keterangan"),
   *              @OA\Property(property="status", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/status"),
   *              @OA\Property(property="verifikasi_upt", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_upt"),
   *              @OA\Property(property="verifikasi_kanwil", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_kanwil"),
   *              @OA\Property(property="verifikasi_ditjen", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_ditjen"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian successfully created"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_pembinaan_kepribadian field is required."})),
   *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
   *              @OA\Property(property="periode", type="array", @OA\Items(example={"Periode field is required."})),
   *              @OA\Property(property="jumlah_hari", type="array", @OA\Items(example={"Jumlah_hari field is required."})),
   *              @OA\Property(property="jumlah_pembinaan_kepribadian", type="array", @OA\Items(example={"Jumlah_pembinaan_kepribadian field is required."})),
   *              @OA\Property(property="jumlah_peserta", type="array", @OA\Items(example={"Jumlah_peserta field is required."})),
   *              @OA\Property(property="jumlah_instruktur_petugas", type="array", @OA\Items(example={"Jumlah_instruktur_petugas field is required."})),
   *              @OA\Property(property="jumlah_instruktur_napi", type="array", @OA\Items(example={"Jumlah_instruktur_napi field is required."})),
   *              @OA\Property(property="jumlah_instruktur_instansi_lain", type="array", @OA\Items(example={"Jumlah_instruktur_instansi_lain field is required."})),
   *              @OA\Property(property="jumlah_instruktur_mitra", type="array", @OA\Items(example={"Jumlah_instruktur_mitra field is required."})),
   *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
   *              @OA\Property(property="verifikasi_upt", type="array", @OA\Items(example={"Verifikasi_upt field is required."})),
   *              @OA\Property(property="verifikasi_kanwil", type="array", @OA\Items(example={"Verifikasi_kanwil field is required."})),
   *              @OA\Property(property="verifikasi_ditjen", type="array", @OA\Items(example={"Verifikasi_ditjen field is required."}))
   *          ),
   *      ),
   * )
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
    $this->validate($request, $this->rules);

    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::create($request->all());
    if ($laporanpembinaankepribadian->exists) {
      return response()->json([
        'status' => 200,
        'message' => "LaporanPembinaanKepribadian berhasil ditambahkan.",
        'data' => $laporanpembinaankepribadian
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "LaporanPembinaanKepribadian tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/laporanpembinaankepribadian/{id}",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="Update LaporanPembinaanKepribadian",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="LaporanPembinaanKepribadian ID"),
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
   *              @OA\Property(property="id_upt", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/id_upt"),
   *              @OA\Property(property="periode", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/periode"),
   *              @OA\Property(property="jumlah_hari", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_hari"),
   *              @OA\Property(property="jumlah_pembinaan_kepribadian", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_pembinaan_kepribadian"),
   *              @OA\Property(property="jumlah_peserta", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_peserta"),
   *              @OA\Property(property="jumlah_instruktur_petugas", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_petugas"),
   *              @OA\Property(property="jumlah_instruktur_napi", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_napi"),
   *              @OA\Property(property="jumlah_instruktur_instansi_lain", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_instansi_lain"),
   *              @OA\Property(property="jumlah_instruktur_mitra", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/jumlah_instruktur_mitra"),
   *              @OA\Property(property="keterangan", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/keterangan"),
   *              @OA\Property(property="status", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/status"),
   *              @OA\Property(property="verifikasi_upt", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_upt"),
   *              @OA\Property(property="verifikasi_kanwil", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_kanwil"),
   *              @OA\Property(property="verifikasi_ditjen", ref="#/components/schemas/LaporanPembinaanKepribadian/properties/verifikasi_ditjen"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian successfully updated"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_pembinaan_kepribadian field is required."})),
   *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
   *              @OA\Property(property="periode", type="array", @OA\Items(example={"Periode field is required."})),
   *              @OA\Property(property="jumlah_hari", type="array", @OA\Items(example={"Jumlah_hari field is required."})),
   *              @OA\Property(property="jumlah_pembinaan_kepribadian", type="array", @OA\Items(example={"Jumlah_pembinaan_kepribadian field is required."})),
   *              @OA\Property(property="jumlah_peserta", type="array", @OA\Items(example={"Jumlah_peserta field is required."})),
   *              @OA\Property(property="jumlah_instruktur_petugas", type="array", @OA\Items(example={"Jumlah_instruktur_petugas field is required."})),
   *              @OA\Property(property="jumlah_instruktur_napi", type="array", @OA\Items(example={"Jumlah_instruktur_napi field is required."})),
   *              @OA\Property(property="jumlah_instruktur_instansi_lain", type="array", @OA\Items(example={"Jumlah_instruktur_instansi_lain field is required."})),
   *              @OA\Property(property="jumlah_instruktur_mitra", type="array", @OA\Items(example={"Jumlah_instruktur_mitra field is required."})),
   *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
   *              @OA\Property(property="verifikasi_upt", type="array", @OA\Items(example={"Verifikasi_upt field is required."})),
   *              @OA\Property(property="verifikasi_kanwil", type="array", @OA\Items(example={"Verifikasi_kanwil field is required."})),
   *              @OA\Property(property="verifikasi_ditjen", type="array", @OA\Items(example={"Verifikasi_ditjen field is required."}))
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
    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
    $this->validate($request, $this->rules);

    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id', $id)->firstOrFail();
    if ($laporanpembinaankepribadian->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "LaporanPembinaanKepribadian berhasil diubah.",
        'data' => $laporanpembinaankepribadian
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "LaporanPembinaanKepribadian tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/laporanpembinaankepribadian/{id}",
   *      tags={"LaporanPembinaanKepribadian"},
   *      summary="LaporanPembinaanKepribadian Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="LaporanPembinaanKepribadian ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="LaporanPembinaanKepribadian deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id', $id)->firstOrFail();

    if ($laporanpembinaankepribadian->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "LaporanPembinaanKepribadian berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "LaporanPembinaanKepribadian tidak dapat dihapus.",
        'data' => null
      ]);
    }
  }

  public function exportExcel(Request $request)
  {
    $data = $request->toArray();
    $export = $this->service->exportExcel($data);

    return $export;
  }


  public function exportPdf(Request $request)
  {
    $data = $request->toArray();
    $export = $this->service->printPDF($data);

    return $export;
  }
}
