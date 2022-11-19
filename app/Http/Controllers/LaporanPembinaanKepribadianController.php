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
      'id_pembinaan_kepribadian' => 'nullable',
      'id_upt' => 'nullable',
      'bulan' => 'nullable',
      'tahun' => 'nullable',
      'jumlah_hari' => 'nullable',
      'jumlah_pembinaan_kepribadian' => 'nullable',
      'jumlah_peserta' => 'nullable',
      'jumlah_instruktur_petugas' => 'nullable',
      'jumlah_instruktur_napi' => 'nullable',
      'jumlah_instruktur_instansi_lain' => 'nullable',
      'jumlah_instruktur_mitra' => 'nullable',
      'keterangan' => 'nullable',
      'status' => 'nullable',
      'verifikasi_upt' => 'nullable',
      'verifikasi_kanwil' => 'nullable',
      'verifikasi_ditjen' => 'nullable',
      'update_terakhir' => 'nullable',
      'update_oleh' => 'nullable',
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
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_laporan_pk:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_pembinaan_kepribadian,id_upt,bulan,tahun,jumlah_hari,jumlah_pembinaan_kepribadian,jumlah_peserta,jumlah_instruktur_petugas,jumlah_instruktur_napi,jumlah_instruktur_instansi_lain,jumlah_instruktur_mitra,keterangan,status,verifikasi_upt,verifikasi_kanwil,verifikasi_ditjen,update_terakhir,update_oleh"),
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
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_laporan_pk"];
    $columns[] = "id_laporan_pk";
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
        'Field' => 'id_laporan_pk',
        'Type' => 'INT()',
        'Null' => 'NO',
        'Key' => 'PRI',
        'Default' => NULL,
        'Extra' => '',
      ),
      1 =>
      array(
        'Field' => 'id_pembinaan_kepribadian',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      2 =>
      array(
        'Field' => 'id_upt',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      3 =>
      array(
        'Field' => 'bulan',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'tahun',
        'Type' => 'INT()',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'jumlah_hari',
        'Type' => 'DECIMAL(, 2)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'jumlah_pembinaan_kepribadian',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'jumlah_peserta',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'jumlah_instruktur_petugas',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'jumlah_instruktur_napi',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'jumlah_instruktur_instansi_lain',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'jumlah_instruktur_mitra',
        'Type' => 'DECIMAL(, 4)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'keterangan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'status',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'verifikasi_upt',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'verifikasi_kanwil',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'verifikasi_ditjen',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'update_terakhir',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      18 =>
      array(
        'Field' => 'update_oleh',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
    );
    $schema = array(
      'name' => 'laporanpembinaankepribadian',
      'module' => 'lain-lain',
      'primary_key' => 'id_laporan_pk',
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
    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id_laporan_pk', $id)->firstOrFail();
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

    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id_laporan_pk', $id)->firstOrFail();
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
    $laporanpembinaankepribadian = LaporanPembinaanKepribadian::where('id_laporan_pk', $id)->firstOrFail();

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
}
