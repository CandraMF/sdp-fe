<?php

namespace App\Http\Controllers;

use App\Models\StatusPrasaranaRuang;
use App\Services\StatusPrasaranaRuangService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusPrasaranaRuangController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new StatusPrasaranaRuangService();
    $this->rules = array(
      'id_prasarana_ruang' => 'required',
      'tanggal' => 'required',
      'status' => 'required',
      'kepemilikan' => 'required',
      'luas' => 'required',
      'satuan_luas' => 'required',
      'jumlah_lantai' => 'required',
      'jumlah_ruang' => 'required',
      'kondisi_baik' => 'required',
      'kondisi_rusak' => 'required',
      'satuan_kondisi' => 'required',
      'foto' => 'required',
      'pendaftaran_disnaker' => 'nullable',
      'catatan_disnaker' => 'nullable',
      'keterangan' => 'nullable',
    );
  }

  /**
   * @OA\Get(
   *      path="/statusprasaranaruang",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="List of StatusPrasaranaRuang",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_ruang:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_ruang,tanggal,status,kepemilikan,luas,satuan_luas,jumlah_lantai,jumlah_ruang,kondisi_baik,kondisi_rusak,satuan_kondisi,foto,pendaftaran_disnaker,catatan_disnaker,keterangan"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang data successfully loaded"),
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
    $statusprasaranaruang = $this->service->search($data, $request->url());

    return response()->json($statusprasaranaruang);
  }

  /**
   * @OA\Get(
   *      path="/statusprasaranaruang/dropdown",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="List of StatusPrasaranaRuang",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang data successfully loaded"),
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
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_prasarana_ruang"];
    $columns[] = "id";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = StatusPrasaranaRuang::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $statusprasaranaruang = $data->get();

    return response()->json($statusprasaranaruang);
  }

  /**
   * @OA\Get(
   *      path="/statusprasaranaruang/schema",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="Schema of StatusPrasaranaRuang",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang schema successfully loaded"),
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
        'Field' => 'id_prasarana_ruang',
        'Type' => 'INT()',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      2 =>
      array(
        'Field' => 'tanggal',
        'Type' => 'DATETIME',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      3 =>
      array(
        'Field' => 'status',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'kepemilikan',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'luas',
        'Type' => 'DECIMAL(, 6)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'satuan_luas',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'jumlah_lantai',
        'Type' => 'DECIMAL(, 3)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'jumlah_ruang',
        'Type' => 'DECIMAL(, 3)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'kondisi_baik',
        'Type' => 'DECIMAL(, 6)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'kondisi_rusak',
        'Type' => 'DECIMAL(, 6)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'satuan_kondisi',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'foto',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'pendaftaran_disnaker',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'catatan_disnaker',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'keterangan',
        'Type' => 'VARCHAR(200)',
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
      'name' => 'statusprasaranaruang',
      'module' => 'lain-lain',
      'primary_key' => 'id',
      'api' => [
        'endpoint' => 'pembinaan-kepribadian',
        'url' => '/statusprasaranaruang'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/statusprasaranaruang/{id}",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="StatusPrasaranaRuang details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="StatusPrasaranaRuang ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $statusprasaranaruang = StatusPrasaranaRuang::where('id', $id)->firstOrFail();

    if (!$statusprasaranaruang->exists) {
      return response()->json([
        'status' => 500,
        'message' => "StatusPrasaranaRuang tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($statusprasaranaruang);
    //$collection = collect($statusprasaranaruang);
    //$merge = $collection->merge($data);    
    return response()->json([
      'status' => 200,
      'message' => "StatusPrasaranaRuang ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/statusprasaranaruang",
   *      tags={"Create StatusPrasaranaRuang"},
   *      summary="Create StatusPrasaranaRuang",
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/StatusPrasaranaRuang/properties/id_prasarana_ruang"),
   *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusPrasaranaRuang/properties/tanggal"),
   *              @OA\Property(property="status", ref="#/components/schemas/StatusPrasaranaRuang/properties/status"),
   *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusPrasaranaRuang/properties/kepemilikan"),
   *              @OA\Property(property="luas", ref="#/components/schemas/StatusPrasaranaRuang/properties/luas"),
   *              @OA\Property(property="satuan_luas", ref="#/components/schemas/StatusPrasaranaRuang/properties/satuan_luas"),
   *              @OA\Property(property="jumlah_lantai", ref="#/components/schemas/StatusPrasaranaRuang/properties/jumlah_lantai"),
   *              @OA\Property(property="jumlah_ruang", ref="#/components/schemas/StatusPrasaranaRuang/properties/jumlah_ruang"),
   *              @OA\Property(property="kondisi_baik", ref="#/components/schemas/StatusPrasaranaRuang/properties/kondisi_baik"),
   *              @OA\Property(property="kondisi_rusak", ref="#/components/schemas/StatusPrasaranaRuang/properties/kondisi_rusak"),
   *              @OA\Property(property="satuan_kondisi", ref="#/components/schemas/StatusPrasaranaRuang/properties/satuan_kondisi"),
   *              @OA\Property(property="foto", ref="#/components/schemas/StatusPrasaranaRuang/properties/foto"),
   *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusPrasaranaRuang/properties/keterangan"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang successfully created"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
   *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
   *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
   *              @OA\Property(property="luas", type="array", @OA\Items(example={"Luas field is required."})),
   *              @OA\Property(property="satuan_luas", type="array", @OA\Items(example={"Satuan_luas field is required."})),
   *              @OA\Property(property="jumlah_lantai", type="array", @OA\Items(example={"Jumlah_lantai field is required."})),
   *              @OA\Property(property="jumlah_ruang", type="array", @OA\Items(example={"Jumlah_ruang field is required."})),
   *              @OA\Property(property="kondisi_baik", type="array", @OA\Items(example={"Kondisi_baik field is required."})),
   *              @OA\Property(property="kondisi_rusak", type="array", @OA\Items(example={"Kondisi_rusak field is required."})),
   *              @OA\Property(property="satuan_kondisi", type="array", @OA\Items(example={"Satuan_kondisi field is required."})),
   *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
   *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."}))
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

    $statusprasaranaruang = StatusPrasaranaRuang::create($request->all());
    if ($statusprasaranaruang->exists) {
      return response()->json([
        'status' => 200,
        'message' => "StatusPrasaranaRuang berhasil ditambahkan.",
        'data' => $statusprasaranaruang
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "StatusPrasaranaRuang tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/statusprasaranaruang/{id}",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="Update StatusPrasaranaRuang",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusPrasaranaRuang ID"),
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/StatusPrasaranaRuang/properties/id_prasarana_ruang"),
   *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusPrasaranaRuang/properties/tanggal"),
   *              @OA\Property(property="status", ref="#/components/schemas/StatusPrasaranaRuang/properties/status"),
   *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusPrasaranaRuang/properties/kepemilikan"),
   *              @OA\Property(property="luas", ref="#/components/schemas/StatusPrasaranaRuang/properties/luas"),
   *              @OA\Property(property="satuan_luas", ref="#/components/schemas/StatusPrasaranaRuang/properties/satuan_luas"),
   *              @OA\Property(property="jumlah_lantai", ref="#/components/schemas/StatusPrasaranaRuang/properties/jumlah_lantai"),
   *              @OA\Property(property="jumlah_ruang", ref="#/components/schemas/StatusPrasaranaRuang/properties/jumlah_ruang"),
   *              @OA\Property(property="kondisi_baik", ref="#/components/schemas/StatusPrasaranaRuang/properties/kondisi_baik"),
   *              @OA\Property(property="kondisi_rusak", ref="#/components/schemas/StatusPrasaranaRuang/properties/kondisi_rusak"),
   *              @OA\Property(property="satuan_kondisi", ref="#/components/schemas/StatusPrasaranaRuang/properties/satuan_kondisi"),
   *              @OA\Property(property="foto", ref="#/components/schemas/StatusPrasaranaRuang/properties/foto"),
   *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusPrasaranaRuang/properties/keterangan"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang successfully updated"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
   *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
   *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
   *              @OA\Property(property="luas", type="array", @OA\Items(example={"Luas field is required."})),
   *              @OA\Property(property="satuan_luas", type="array", @OA\Items(example={"Satuan_luas field is required."})),
   *              @OA\Property(property="jumlah_lantai", type="array", @OA\Items(example={"Jumlah_lantai field is required."})),
   *              @OA\Property(property="jumlah_ruang", type="array", @OA\Items(example={"Jumlah_ruang field is required."})),
   *              @OA\Property(property="kondisi_baik", type="array", @OA\Items(example={"Kondisi_baik field is required."})),
   *              @OA\Property(property="kondisi_rusak", type="array", @OA\Items(example={"Kondisi_rusak field is required."})),
   *              @OA\Property(property="satuan_kondisi", type="array", @OA\Items(example={"Satuan_kondisi field is required."})),
   *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
   *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."}))
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

    $statusprasaranaruang = StatusPrasaranaRuang::where('id', $id)->firstOrFail();
    if ($statusprasaranaruang->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "StatusPrasaranaRuang berhasil diubah.",
        'data' => $statusprasaranaruang
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "StatusPrasaranaRuang tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/statusprasaranaruang/{id}",
   *      tags={"StatusPrasaranaRuang"},
   *      summary="StatusPrasaranaRuang Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusPrasaranaRuang ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="StatusPrasaranaRuang deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $statusprasaranaruang = StatusPrasaranaRuang::where('id', $id)->firstOrFail();

    if ($statusprasaranaruang->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "StatusPrasaranaRuang berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "StatusPrasaranaRuang tidak dapat dihapus.",
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
