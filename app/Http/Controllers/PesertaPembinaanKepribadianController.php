<?php

namespace App\Http\Controllers;

use App\Models\PesertaPembinaanKepribadian;
use App\Services\PesertaPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PesertaPembinaanKepribadianService();
        $this->rules = array (
  'id_daftar_pembinaan_kepribadian' => 'required',
  'id_wbp' => 'required',
  'kehadiran' => 'required',
  'no_sertifikat' => 'required',
  'file_sertifikat' => 'required',
  'nilai' => 'required',
  'predikat' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/pesertapembinaankepribadian",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="List of PesertaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_daftar_pembinaan_kepribadian:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_daftar_pembinaan_kepribadian,id_wbp,kehadiran,no_sertifikat,file_sertifikat,nilai,predikat"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian data successfully loaded"),
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
        $pesertapembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($pesertapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/pesertapembinaankepribadian/dropdown",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="List of PesertaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_daftar_pembinaan_kepribadian"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = PesertaPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $pesertapembinaankepribadian = $data->get();

        return response()->json($pesertapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/pesertapembinaankepribadian/schema",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="Schema of PesertaPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian schema successfully loaded"),
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
    'Field' => 'id_daftar_pembinaan_kepribadian',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'id_wbp',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'kehadiran',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'no_sertifikat',
    'Type' => 'VARCHAR(50)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'file_sertifikat',
    'Type' => 'VARCHAR(200)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'nilai',
    'Type' => 'DECIMAL(, 3)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'predikat',
    'Type' => 'VARCHAR(50)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'updated_at',
    'Type' => 'TIMESTAMP',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
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
            'name' => 'pesertapembinaankepribadian', 
            'module' => 'lain-lain', 
            'primary_key' => 'id', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/pesertapembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/pesertapembinaankepribadian/{id}",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="PesertaPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PesertaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesertapembinaankepribadian = PesertaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$pesertapembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($pesertapembinaankepribadian);
        //$collection = collect($pesertapembinaankepribadian);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PesertaPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/pesertapembinaankepribadian",
     *      tags={"Create PesertaPembinaanKepribadian"},
     *      summary="Create PesertaPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_daftar_pembinaan_kepribadian", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/id_daftar_pembinaan_kepribadian"),
*              @OA\Property(property="id_wbp", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/id_wbp"),
*              @OA\Property(property="kehadiran", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/kehadiran"),
*              @OA\Property(property="no_sertifikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/no_sertifikat"),
*              @OA\Property(property="file_sertifikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/file_sertifikat"),
*              @OA\Property(property="nilai", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/nilai"),
*              @OA\Property(property="predikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/predikat"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_daftar_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_daftar_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_wbp", type="array", @OA\Items(example={"Id_wbp field is required."})),
*              @OA\Property(property="kehadiran", type="array", @OA\Items(example={"Kehadiran field is required."})),
*              @OA\Property(property="no_sertifikat", type="array", @OA\Items(example={"No_sertifikat field is required."})),
*              @OA\Property(property="file_sertifikat", type="array", @OA\Items(example={"File_sertifikat field is required."})),
*              @OA\Property(property="nilai", type="array", @OA\Items(example={"Nilai field is required."})),
*              @OA\Property(property="predikat", type="array", @OA\Items(example={"Predikat field is required."}))
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

        $pesertapembinaankepribadian = PesertaPembinaanKepribadian::create($request->all());
        if ($pesertapembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPembinaanKepribadian berhasil ditambahkan.",
                'data' => $pesertapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/pesertapembinaankepribadian/{id}",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="Update PesertaPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PesertaPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_daftar_pembinaan_kepribadian", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/id_daftar_pembinaan_kepribadian"),
*              @OA\Property(property="id_wbp", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/id_wbp"),
*              @OA\Property(property="kehadiran", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/kehadiran"),
*              @OA\Property(property="no_sertifikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/no_sertifikat"),
*              @OA\Property(property="file_sertifikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/file_sertifikat"),
*              @OA\Property(property="nilai", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/nilai"),
*              @OA\Property(property="predikat", ref="#/components/schemas/PesertaPembinaanKepribadian/properties/predikat"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_daftar_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_daftar_pembinaan_kepribadian field is required."})),
*              @OA\Property(property="id_wbp", type="array", @OA\Items(example={"Id_wbp field is required."})),
*              @OA\Property(property="kehadiran", type="array", @OA\Items(example={"Kehadiran field is required."})),
*              @OA\Property(property="no_sertifikat", type="array", @OA\Items(example={"No_sertifikat field is required."})),
*              @OA\Property(property="file_sertifikat", type="array", @OA\Items(example={"File_sertifikat field is required."})),
*              @OA\Property(property="nilai", type="array", @OA\Items(example={"Nilai field is required."})),
*              @OA\Property(property="predikat", type="array", @OA\Items(example={"Predikat field is required."}))
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

        $pesertapembinaankepribadian = PesertaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($pesertapembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPembinaanKepribadian berhasil diubah.",
                'data' => $pesertapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/pesertapembinaankepribadian/{id}",
     *      tags={"PesertaPembinaanKepribadian"},
     *      summary="PesertaPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PesertaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesertapembinaankepribadian = PesertaPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($pesertapembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPembinaanKepribadian tidak dapat dihapus.",
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
