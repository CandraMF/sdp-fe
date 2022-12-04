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
        $this->rules = array (
  'id_jenis_pembinaan_kepribadian' => 'required',
  'id_upt' => 'required',
  'id_mitra' => 'required',
  'nama_program' => 'required',
  'program_wajib' => 'required',
  'materi_pembinaan_kepribadian' => 'required',
  'id_instruktur' => 'required',
  'penangung_jawab' => 'required',
  'tanggal_mulai' => 'required',
  'tanggal_selesai' => 'required',
  'tempat_pelaksanaan' => 'required',
  'perlu_kelulusan' => 'required',
  'id_sarana' => 'required',
  'id_prasarana' => 'required',
  'realisasi_anggaran' => 'nullable',
  'id_jenis_anggaran' => 'nullable',
  'foto' => 'required',
  'keterangan' => 'nullable',
  'status' => 'required',
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
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jenis_pembinaan_kepribadian:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_pembinaan_kepribadian,id_upt,id_mitra,nama_program,program_wajib,materi_pembinaan_kepribadian,id_instruktur,penangung_jawab,tanggal_mulai,tanggal_selesai,tempat_pelaksanaan,perlu_kelulusan,id_sarana,id_prasarana,realisasi_anggaran,id_jenis_anggaran,foto,keterangan,status"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_jenis_pembinaan_kepribadian"];
        $columns[] = "id";
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
        $fields = array (
  0 => 
  array (
    'Field' => 'id',
    'Type' => 'BIGINT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => ' UNSIGNED AUTO_INCREMENT',
  ),
  1 => 
  array (
    'Field' => 'id_jenis_pembinaan_kepribadian',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'id_upt',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'id_mitra',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'nama_program',
    'Type' => 'VARCHAR(200)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'program_wajib',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'materi_pembinaan_kepribadian',
    'Type' => 'VARCHAR(200)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'id_instruktur',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'penangung_jawab',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'tanggal_mulai',
    'Type' => 'DATETIME',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'tanggal_selesai',
    'Type' => 'DATETIME',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'tempat_pelaksanaan',
    'Type' => 'VARCHAR(200)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  12 => 
  array (
    'Field' => 'perlu_kelulusan',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  13 => 
  array (
    'Field' => 'id_sarana',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  14 => 
  array (
    'Field' => 'id_prasarana',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  15 => 
  array (
    'Field' => 'realisasi_anggaran',
    'Type' => 'DECIMAL(, 18)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  16 => 
  array (
    'Field' => 'id_jenis_anggaran',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  17 => 
  array (
    'Field' => 'foto',
    'Type' => 'VARCHAR(200)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  18 => 
  array (
    'Field' => 'keterangan',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  19 => 
  array (
    'Field' => 'status',
    'Type' => 'VARCHAR(50)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  20 => 
  array (
    'Field' => 'updated_at',
    'Type' => 'TIMESTAMP',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  21 => 
  array (
    'Field' => 'updated_by',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'pembinaankepribadian', 
            'module' => 'lain-lain', 
            'primary_key' => 'id', 
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
        $pembinaankepribadian = PembinaanKepribadian::where('id', $id)->firstOrFail();
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
     *              @OA\Property(property="id_jenis_pembinaan_kepribadian", ref="#/components/schemas/PembinaanKepribadian/properties/id_jenis_pembinaan_kepribadian"),
*              @OA\Property(property="id_upt", ref="#/components/schemas/PembinaanKepribadian/properties/id_upt"),
*              @OA\Property(property="id_mitra", ref="#/components/schemas/PembinaanKepribadian/properties/id_mitra"),
*              @OA\Property(property="nama_program", ref="#/components/schemas/PembinaanKepribadian/properties/nama_program"),
*              @OA\Property(property="program_wajib", ref="#/components/schemas/PembinaanKepribadian/properties/program_wajib"),
*              @OA\Property(property="materi_pembinaan_kepribadian", ref="#/components/schemas/PembinaanKepribadian/properties/materi_pembinaan_kepribadian"),
*              @OA\Property(property="id_instruktur", ref="#/components/schemas/PembinaanKepribadian/properties/id_instruktur"),
*              @OA\Property(property="penangung_jawab", ref="#/components/schemas/PembinaanKepribadian/properties/penangung_jawab"),
*              @OA\Property(property="tanggal_mulai", ref="#/components/schemas/PembinaanKepribadian/properties/tanggal_mulai"),
*              @OA\Property(property="tanggal_selesai", ref="#/components/schemas/PembinaanKepribadian/properties/tanggal_selesai"),
*              @OA\Property(property="tempat_pelaksanaan", ref="#/components/schemas/PembinaanKepribadian/properties/tempat_pelaksanaan"),
*              @OA\Property(property="perlu_kelulusan", ref="#/components/schemas/PembinaanKepribadian/properties/perlu_kelulusan"),
*              @OA\Property(property="id_sarana", ref="#/components/schemas/PembinaanKepribadian/properties/id_sarana"),
*              @OA\Property(property="id_prasarana", ref="#/components/schemas/PembinaanKepribadian/properties/id_prasarana"),
*              @OA\Property(property="foto", ref="#/components/schemas/PembinaanKepribadian/properties/foto"),
*              @OA\Property(property="status", ref="#/components/schemas/PembinaanKepribadian/properties/status"),
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
     *              @OA\Property(property="id_jenis_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_jenis_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
*              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
*              @OA\Property(property="nama_program", type="array", @OA\Items(example={"Nama_program field is required."})),
*              @OA\Property(property="program_wajib", type="array", @OA\Items(example={"Program_wajib field is required."})),
*              @OA\Property(property="materi_pembinaan_kepribadian", type="array", @OA\Items(example={"Materi_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
*              @OA\Property(property="penangung_jawab", type="array", @OA\Items(example={"Penangung_jawab field is required."})),
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
        $request->merge(['update_at' => date('Y-m-d H:i:s')]);
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
     *              @OA\Property(property="id_jenis_pembinaan_kepribadian", ref="#/components/schemas/PembinaanKepribadian/properties/id_jenis_pembinaan_kepribadian"),
*              @OA\Property(property="id_upt", ref="#/components/schemas/PembinaanKepribadian/properties/id_upt"),
*              @OA\Property(property="id_mitra", ref="#/components/schemas/PembinaanKepribadian/properties/id_mitra"),
*              @OA\Property(property="nama_program", ref="#/components/schemas/PembinaanKepribadian/properties/nama_program"),
*              @OA\Property(property="program_wajib", ref="#/components/schemas/PembinaanKepribadian/properties/program_wajib"),
*              @OA\Property(property="materi_pembinaan_kepribadian", ref="#/components/schemas/PembinaanKepribadian/properties/materi_pembinaan_kepribadian"),
*              @OA\Property(property="id_instruktur", ref="#/components/schemas/PembinaanKepribadian/properties/id_instruktur"),
*              @OA\Property(property="penangung_jawab", ref="#/components/schemas/PembinaanKepribadian/properties/penangung_jawab"),
*              @OA\Property(property="tanggal_mulai", ref="#/components/schemas/PembinaanKepribadian/properties/tanggal_mulai"),
*              @OA\Property(property="tanggal_selesai", ref="#/components/schemas/PembinaanKepribadian/properties/tanggal_selesai"),
*              @OA\Property(property="tempat_pelaksanaan", ref="#/components/schemas/PembinaanKepribadian/properties/tempat_pelaksanaan"),
*              @OA\Property(property="perlu_kelulusan", ref="#/components/schemas/PembinaanKepribadian/properties/perlu_kelulusan"),
*              @OA\Property(property="id_sarana", ref="#/components/schemas/PembinaanKepribadian/properties/id_sarana"),
*              @OA\Property(property="id_prasarana", ref="#/components/schemas/PembinaanKepribadian/properties/id_prasarana"),
*              @OA\Property(property="foto", ref="#/components/schemas/PembinaanKepribadian/properties/foto"),
*              @OA\Property(property="status", ref="#/components/schemas/PembinaanKepribadian/properties/status"),
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
     *              @OA\Property(property="id_jenis_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_jenis_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
*              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
*              @OA\Property(property="nama_program", type="array", @OA\Items(example={"Nama_program field is required."})),
*              @OA\Property(property="program_wajib", type="array", @OA\Items(example={"Program_wajib field is required."})),
*              @OA\Property(property="materi_pembinaan_kepribadian", type="array", @OA\Items(example={"Materi_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
*              @OA\Property(property="penangung_jawab", type="array", @OA\Items(example={"Penangung_jawab field is required."})),
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
        $request->merge(['update_at' => date('Y-m-d H:i:s')]);
$this->validate($request, $this->rules);

        $pembinaankepribadian = PembinaanKepribadian::where('id', $id)->firstOrFail();
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
        $pembinaankepribadian = PembinaanKepribadian::where('id', $id)->firstOrFail();

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
