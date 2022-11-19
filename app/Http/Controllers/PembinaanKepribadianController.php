<?php

namespace App\Http\Controllers;

use App\Models\PembinaanKepribadian;
use App\Services\PembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembinaanKepribadianController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new PembinaanKepribadianService();
    $this->rules = array(
      'id_jenis_pembinaan_kepribadian' => 'nullable',
      'id_upt' => 'nullable',
      'id_mitra' => 'nullable',
      'nama_program' => 'nullable',
      'program_wajib' => 'nullable',
      'materi_pembinaan_kepribadian' => 'nullable',
      'id_instruktur' => 'nullable',
      'penangung_jawab' => 'nullable',
      'tanggal_mulai' => 'nullable',
      'tanggal_selesai' => 'nullable',
      'tempat_pelaksanaan' => 'nullable',
      'perlu_kelulusan' => 'nullable',
      'id_sarana' => 'nullable',
      'id_prasarana' => 'nullable',
      'realisasi_anggaran' => 'nullable',
      'id_jenis_anggaran' => 'nullable',
      'foto' => 'nullable',
      'keterangan' => 'nullable',
      'status' => 'nullable',
      'update_terakhir' => 'nullable',
      'update_oleh' => 'nullable',
    );
  }

  /**
   * @OA\Get(
   *      path="/pembinaankepribadian",
   *      tags={"PembinaanKepribadian"},
   *      summary="List of PembinaanKepribadian",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_pembinaan_kepribadian:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_pembinaan_kepribadian,id_upt,id_mitra,nama_program,program_wajib,materi_pembinaan_kepribadian,id_instruktur,penangung_jawab,tanggal_mulai,tanggal_selesai,tempat_pelaksanaan,perlu_kelulusan,id_sarana,id_prasarana,realisasi_anggaran,id_jenis_anggaran,foto,keterangan,status,update_terakhir,update_oleh"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian data successfully loaded"),
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
    $pembinaankepribadian = $this->service->search($data, $request->url());

    return response()->json($pembinaankepribadian);
  }

  /**
   * @OA\Get(
   *      path="/pembinaankepribadian/dropdown",
   *      tags={"PembinaanKepribadian"},
   *      summary="List of PembinaanKepribadian",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian data successfully loaded"),
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
    $columns[] = "id_pembinaan_kepribadian";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = PembinaanKepribadian::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $pembinaankepribadian = $data->get();

    return response()->json($pembinaankepribadian);
  }

  /**
   * @OA\Get(
   *      path="/pembinaankepribadian/schema",
   *      tags={"PembinaanKepribadian"},
   *      summary="Schema of PembinaanKepribadian",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian schema successfully loaded"),
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
        'Field' => 'id_pembinaan_kepribadian',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => 'PRI',
        'Default' => NULL,
        'Extra' => '',
      ),
      1 =>
      array(
        'Field' => 'id_jenis_pembinaan_kepribadian',
        'Type' => 'VARCHAR(32)',
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
        'Field' => 'id_mitra',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'nama_program',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'program_wajib',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'materi_pembinaan_kepribadian',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'id_instruktur',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'penangung_jawab',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'tanggal_mulai',
        'Type' => 'DATETIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'tanggal_selesai',
        'Type' => 'DATETIME',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'tempat_pelaksanaan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'perlu_kelulusan',
        'Type' => 'TINYINT(1)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'id_sarana',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'id_prasarana',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'realisasi_anggaran',
        'Type' => 'DECIMAL(, 10)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'id_jenis_anggaran',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'foto',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      18 =>
      array(
        'Field' => 'keterangan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      19 =>
      array(
        'Field' => 'status',
        'Type' => 'VARCHAR(50)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      20 =>
      array(
        'Field' => 'update_terakhir',
        'Type' => 'TIMESTAMP',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      21 =>
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
      'name' => 'pembinaankepribadian',
      'module' => 'lain-lain',
      'primary_key' => 'id_pembinaan_kepribadian',
      'api' => [
        'endpoint' => 'pembinaan-kepribadian',
        'url' => '/pembinaankepribadian'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/pembinaankepribadian/{id}",
   *      tags={"PembinaanKepribadian"},
   *      summary="PembinaanKepribadian details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PembinaanKepribadian ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $pembinaankepribadian = PembinaanKepribadian::where('id_pembinaan_kepribadian', $id)->firstOrFail();
    if (!$pembinaankepribadian->exists) {
      return response()->json([
        'status' => 500,
        'message' => "PembinaanKepribadian tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($pembinaankepribadian);
    //$collection = collect($pembinaankepribadian);
    //$merge = $collection->merge($data);    
    return response()->json([
      'status' => 200,
      'message' => "PembinaanKepribadian ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/pembinaankepribadian",
   *      tags={"Create PembinaanKepribadian"},
   *      summary="Create PembinaanKepribadian",
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
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian successfully created"),
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

    $pembinaankepribadian = PembinaanKepribadian::create($request->all());
    if ($pembinaankepribadian->exists) {
      return response()->json([
        'status' => 200,
        'message' => "PembinaanKepribadian berhasil ditambahkan.",
        'data' => $pembinaankepribadian
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PembinaanKepribadian tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/pembinaankepribadian/{id}",
   *      tags={"PembinaanKepribadian"},
   *      summary="Update PembinaanKepribadian",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PembinaanKepribadian ID"),
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
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian successfully updated"),
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

    $pembinaankepribadian = PembinaanKepribadian::where('id_pembinaan_kepribadian', $id)->firstOrFail();
    if ($pembinaankepribadian->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "PembinaanKepribadian berhasil diubah.",
        'data' => $pembinaankepribadian
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PembinaanKepribadian tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/pembinaankepribadian/{id}",
   *      tags={"PembinaanKepribadian"},
   *      summary="PembinaanKepribadian Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PembinaanKepribadian ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PembinaanKepribadian deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pembinaankepribadian = PembinaanKepribadian::where('id_pembinaan_kepribadian', $id)->firstOrFail();

    if ($pembinaankepribadian->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "PembinaanKepribadian berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PembinaanKepribadian tidak dapat dihapus.",
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
