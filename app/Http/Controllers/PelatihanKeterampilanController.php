<?php

namespace App\Http\Controllers;

use App\Models\PelatihanKeterampilan;
use App\Services\PelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelatihanKeterampilanController extends Controller
{

  protected $service;
  protected $rules;

  public function __construct()
  {
    $this->service = new PelatihanKeterampilanService();
    $this->rules = array(
      'id_jenis_pelatihan_keterampilan' => 'required',
      'id_upt' => 'required',
      'id_bidang' => 'required',
      'tingkat' => 'required',
      'id_mitra' => 'required',
      'nama_program' => 'required',
      'program_wajib' => 'required',
      'materi_pelatihan_keterampilan' => 'required',
      'id_instruktur' => 'nullable',
      'penanggung_jawab' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_selesai' => 'required',
      'tempat_pelaksanaan' => 'required',
      'perlu_kelulusan' => 'required',
      'id_sarana' => 'nullable',
      'id_prasarana' => 'nullable',
      'realisasi_anggaran' => 'nullable',
      'id_jenis_anggaran' => 'nullable',
      'foto' => 'required',
      'keterangan' => 'nullable',
      'status' => 'required',
    );
  }

  /**
   * @OA\Get(
   *      path="/pelatihanketerampilan",
   *      tags={"PelatihanKeterampilan"},
   *      summary="List of PelatihanKeterampilan",
   *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
   *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
   *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
   *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jenis_pelatihan_keterampilan:desc"),
   *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_pelatihan_keterampilan,id_upt,id_mitra,nama_program,program_wajib,materi_pelatihan_keterampilan,id_instruktur,penanggung_jawab,tanggal_mulai,tanggal_selesai,tempat_pelaksanaan,perlu_kelulusan,id_sarana,id_prasarana,realisasi_anggaran,id_jenis_anggaran,foto,keterangan,status"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan data successfully loaded"),
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
    $pelatihanketerampilan = $this->service->search($data, $request->url());

    return response()->json($pelatihanketerampilan);
  }

  /**
   * @OA\Get(
   *      path="/pelatihanketerampilan/dropdown",
   *      tags={"PelatihanKeterampilan"},
   *      summary="List of PelatihanKeterampilan",
   *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
   *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan data successfully loaded"),
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
    $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_jenis_pelatihan_keterampilan"];
    $columns[] = "id";
    foreach ($col as $c) {
      $columns[] = $c;
    }

    $data = PelatihanKeterampilan::select($columns);
    if ($request->has("filter_col") && $request->has("filter_val")) {
      $fcol = explode(",", $request->filter_col);
      $fval = explode(",", $request->filter_val);
      for ($i = 0; $i < count($fcol); $i++) {
        $filter_val = ($fval[$i]) ? $fval[$i] : "";
        $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
      }
    }
    $pelatihanketerampilan = $data->get();

    return response()->json($pelatihanketerampilan);
  }

  /**
   * @OA\Get(
   *      path="/pelatihanketerampilan/schema",
   *      tags={"PelatihanKeterampilan"},
   *      summary="Schema of PelatihanKeterampilan",
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan schema successfully loaded"),
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
        'Field' => 'id_jenis_pelatihan_keterampilan',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
	  2 =>
      array(
        'Field' => 'id_bidang',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
	  3 =>
      array(
        'Field' => 'tingkat',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      4 =>
      array(
        'Field' => 'id_upt',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      5 =>
      array(
        'Field' => 'id_mitra',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      6 =>
      array(
        'Field' => 'nama_program',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      7 =>
      array(
        'Field' => 'program_wajib',
        'Type' => 'TINYINT(1)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      8 =>
      array(
        'Field' => 'materi_pelatihan_keterampilan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      9 =>
      array(
        'Field' => 'id_instruktur',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      10 =>
      array(
        'Field' => 'penanggung_jawab',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      11 =>
      array(
        'Field' => 'tanggal_mulai',
        'Type' => 'DATETIME',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      12 =>
      array(
        'Field' => 'tanggal_selesai',
        'Type' => 'DATETIME',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      13 =>
      array(
        'Field' => 'tempat_pelaksanaan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      14 =>
      array(
        'Field' => 'perlu_kelulusan',
        'Type' => 'TINYINT(1)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      15 =>
      array(
        'Field' => 'id_sarana',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      16 =>
      array(
        'Field' => 'id_prasarana',
        'Type' => 'VARCHAR(32)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      17 =>
      array(
        'Field' => 'realisasi_anggaran',
        'Type' => 'DECIMAL(, 18)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      18 =>
      array(
        'Field' => 'id_jenis_anggaran',
        'Type' => 'VARCHAR(32)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      19 =>
      array(
        'Field' => 'foto',
        'Type' => 'VARCHAR(200)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      20 =>
      array(
        'Field' => 'keterangan',
        'Type' => 'VARCHAR(200)',
        'Null' => 'YES',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      21 =>
      array(
        'Field' => 'status',
        'Type' => 'VARCHAR(50)',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      22 =>
      array(
        'Field' => 'updated_at',
        'Type' => 'TIMESTAMP',
        'Null' => 'NO',
        'Key' => NULL,
        'Default' => NULL,
        'Extra' => '',
      ),
      23 =>
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
      'name' => 'pelatihanketerampilan',
      'module' => 'lain-lain',
      'primary_key' => 'id',
      'api' => [
        'endpoint' => 'pelatihan-keterampilan',
        'url' => '/pelatihanketerampilan'
      ],
      'scheme' => array_values($fields),
    );
    return response()->json($schema);
  }

  /**
   * @OA\Get(
   *      path="/pelatihanketerampilan/{id}",
   *      tags={"PelatihanKeterampilan"},
   *      summary="PelatihanKeterampilan details",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PelatihanKeterampilan ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan successfully loaded"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $pelatihanketerampilan = PelatihanKeterampilan::where('id', $id)->firstOrFail();
    if (!$pelatihanketerampilan->exists) {
      return response()->json([
        'status' => 500,
        'message' => "PelatihanKeterampilan tidak dapat ditemukan.",
        'data' => null
      ]);
    }

    $data = $this->service->show($pelatihanketerampilan);
    //$collection = collect($pelatihanketerampilan);
    //$merge = $collection->merge($data);
    return response()->json([
      'status' => 200,
      'message' => "PelatihanKeterampilan ditemukan.",
      'data' => $data //$merge->all()
    ]);
  }

  /**
   * @OA\Post(
   *      path="/pelatihanketerampilan",
   *      tags={"Create PelatihanKeterampilan"},
   *      summary="Create PelatihanKeterampilan",
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_jenis_pelatihan_keterampilan", ref="#/components/schemas/PelatihanKeterampilan/properties/id_jenis_pelatihan_keterampilan"),
   *              @OA\Property(property="id_upt", ref="#/components/schemas/PelatihanKeterampilan/properties/id_upt"),
   *              @OA\Property(property="id_mitra", ref="#/components/schemas/PelatihanKeterampilan/properties/id_mitra"),
   *              @OA\Property(property="nama_program", ref="#/components/schemas/PelatihanKeterampilan/properties/nama_program"),
   *              @OA\Property(property="program_wajib", ref="#/components/schemas/PelatihanKeterampilan/properties/program_wajib"),
   *              @OA\Property(property="materi_pelatihan_keterampilan", ref="#/components/schemas/PelatihanKeterampilan/properties/materi_pelatihan_keterampilan"),
   *              @OA\Property(property="id_instruktur", ref="#/components/schemas/PelatihanKeterampilan/properties/id_instruktur"),
   *              @OA\Property(property="penanggung_jawab", ref="#/components/schemas/PelatihanKeterampilan/properties/penanggung_jawab"),
   *              @OA\Property(property="tanggal_mulai", ref="#/components/schemas/PelatihanKeterampilan/properties/tanggal_mulai"),
   *              @OA\Property(property="tanggal_selesai", ref="#/components/schemas/PelatihanKeterampilan/properties/tanggal_selesai"),
   *              @OA\Property(property="tempat_pelaksanaan", ref="#/components/schemas/PelatihanKeterampilan/properties/tempat_pelaksanaan"),
   *              @OA\Property(property="perlu_kelulusan", ref="#/components/schemas/PelatihanKeterampilan/properties/perlu_kelulusan"),
   *              @OA\Property(property="id_sarana", ref="#/components/schemas/PelatihanKeterampilan/properties/id_sarana"),
   *              @OA\Property(property="id_prasarana", ref="#/components/schemas/PelatihanKeterampilan/properties/id_prasarana"),
   *              @OA\Property(property="foto", ref="#/components/schemas/PelatihanKeterampilan/properties/foto"),
   *              @OA\Property(property="status", ref="#/components/schemas/PelatihanKeterampilan/properties/status"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan successfully created"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_jenis_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_jenis_pelatihan_keterampilan field is required."})),
   *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
   *              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
   *              @OA\Property(property="nama_program", type="array", @OA\Items(example={"Nama_program field is required."})),
   *              @OA\Property(property="program_wajib", type="array", @OA\Items(example={"Program_wajib field is required."})),
   *              @OA\Property(property="materi_pelatihan_keterampilan", type="array", @OA\Items(example={"Materi_pelatihan_keterampilan field is required."})),
   *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
   *              @OA\Property(property="penanggung_jawab", type="array", @OA\Items(example={"penanggung_jawab field is required."})),
   *              @OA\Property(property="tanggal_mulai", type="array", @OA\Items(example={"Tanggal_mulai field is required."})),
   *              @OA\Property(property="tanggal_selesai", type="array", @OA\Items(example={"Tanggal_selesai field is required."})),
   *              @OA\Property(property="tempat_pelaksanaan", type="array", @OA\Items(example={"Tempat_pelaksanaan field is required."})),
   *              @OA\Property(property="perlu_kelulusan", type="array", @OA\Items(example={"Perlu_kelulusan field is required."})),
   *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
   *              @OA\Property(property="id_prasarana", type="array", @OA\Items(example={"Id_prasarana field is required."})),
   *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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
        // $user = Auth::user();
        $request->merge(['updated_by' => 'admin']);
    $this->validate($request, $this->rules);

    $pelatihanketerampilan = PelatihanKeterampilan::create($request->all());
    if ($pelatihanketerampilan->exists) {
      return response()->json([
        'status' => 200,
        'message' => "PelatihanKeterampilan berhasil ditambahkan.",
        'data' => $pelatihanketerampilan
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PelatihanKeterampilan tidak dapat ditambahkan.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Put(
   *      path="/pelatihanketerampilan/{id}",
   *      tags={"PelatihanKeterampilan"},
   *      summary="Update PelatihanKeterampilan",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PelatihanKeterampilan ID"),
   *      @OA\RequestBody(
   *         description="Body",
   *         required=true,
   *         @OA\JsonContent(
   *              @OA\Property(property="id_jenis_pelatihan_keterampilan", ref="#/components/schemas/PelatihanKeterampilan/properties/id_jenis_pelatihan_keterampilan"),
   *              @OA\Property(property="id_upt", ref="#/components/schemas/PelatihanKeterampilan/properties/id_upt"),
   *              @OA\Property(property="id_mitra", ref="#/components/schemas/PelatihanKeterampilan/properties/id_mitra"),
   *              @OA\Property(property="nama_program", ref="#/components/schemas/PelatihanKeterampilan/properties/nama_program"),
   *              @OA\Property(property="program_wajib", ref="#/components/schemas/PelatihanKeterampilan/properties/program_wajib"),
   *              @OA\Property(property="materi_pelatihan_keterampilan", ref="#/components/schemas/PelatihanKeterampilan/properties/materi_pelatihan_keterampilan"),
   *              @OA\Property(property="id_instruktur", ref="#/components/schemas/PelatihanKeterampilan/properties/id_instruktur"),
   *              @OA\Property(property="penanggung_jawab", ref="#/components/schemas/PelatihanKeterampilan/properties/penanggung_jawab"),
   *              @OA\Property(property="tanggal_mulai", ref="#/components/schemas/PelatihanKeterampilan/properties/tanggal_mulai"),
   *              @OA\Property(property="tanggal_selesai", ref="#/components/schemas/PelatihanKeterampilan/properties/tanggal_selesai"),
   *              @OA\Property(property="tempat_pelaksanaan", ref="#/components/schemas/PelatihanKeterampilan/properties/tempat_pelaksanaan"),
   *              @OA\Property(property="perlu_kelulusan", ref="#/components/schemas/PelatihanKeterampilan/properties/perlu_kelulusan"),
   *              @OA\Property(property="id_sarana", ref="#/components/schemas/PelatihanKeterampilan/properties/id_sarana"),
   *              @OA\Property(property="id_prasarana", ref="#/components/schemas/PelatihanKeterampilan/properties/id_prasarana"),
   *              @OA\Property(property="foto", ref="#/components/schemas/PelatihanKeterampilan/properties/foto"),
   *              @OA\Property(property="status", ref="#/components/schemas/PelatihanKeterampilan/properties/status"),
   *         ),
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan successfully updated"),
   *          )
   *      ),
   *      @OA\Response(
   *          response="422",
   *          description="error",
   *          @OA\JsonContent(
   *              @OA\Property(property="id_jenis_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_jenis_pelatihan_keterampilan field is required."})),
   *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
   *              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
   *              @OA\Property(property="nama_program", type="array", @OA\Items(example={"Nama_program field is required."})),
   *              @OA\Property(property="program_wajib", type="array", @OA\Items(example={"Program_wajib field is required."})),
   *              @OA\Property(property="materi_pelatihan_keterampilan", type="array", @OA\Items(example={"Materi_pelatihan_keterampilan field is required."})),
   *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
   *              @OA\Property(property="penanggung_jawab", type="array", @OA\Items(example={"penanggung_jawab field is required."})),
   *              @OA\Property(property="tanggal_mulai", type="array", @OA\Items(example={"Tanggal_mulai field is required."})),
   *              @OA\Property(property="tanggal_selesai", type="array", @OA\Items(example={"Tanggal_selesai field is required."})),
   *              @OA\Property(property="tempat_pelaksanaan", type="array", @OA\Items(example={"Tempat_pelaksanaan field is required."})),
   *              @OA\Property(property="perlu_kelulusan", type="array", @OA\Items(example={"Perlu_kelulusan field is required."})),
   *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
   *              @OA\Property(property="id_prasarana", type="array", @OA\Items(example={"Id_prasarana field is required."})),
   *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
   *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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
        // $user = Auth::user();
        $request->merge(['updated_by' => 'admin']);
    $this->validate($request, $this->rules);

    $pelatihanketerampilan = PelatihanKeterampilan::where('id', $id)->firstOrFail();
    if ($pelatihanketerampilan->update($request->all())) {
      return response()->json([
        'status' => 200,
        'message' => "PelatihanKeterampilan berhasil diubah.",
        'data' => $pelatihanketerampilan
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PelatihanKeterampilan tidak dapat diubah.",
        'data' => null
      ]);
    }
  }


  /**
   * @OA\Delete(
   *      path="/pelatihanketerampilan/{id}",
   *      tags={"PelatihanKeterampilan"},
   *      summary="PelatihanKeterampilan Removal",
   *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PelatihanKeterampilan ID"),
   *      @OA\Response(
   *          response=200,
   *          description="success",
   *          @OA\JsonContent(
   *              @OA\Property(property="message", type="string", example="PelatihanKeterampilan deleted"),
   *          ),
   *      ),
   * )
   *
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pelatihanketerampilan = PelatihanKeterampilan::where('id', $id)->firstOrFail();

    if ($pelatihanketerampilan->delete()) {
      return response()->json([
        'status' => 200,
        'message' => "PelatihanKeterampilan berhasil dihapus.",
        'data' => null
      ]);
    } else {
      return response()->json([
        'status' => 500,
        'message' => "PelatihanKeterampilan tidak dapat dihapus.",
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
