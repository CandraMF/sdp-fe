<?php

namespace App\Http\Controllers;

use App\Models\JadwalPembinaanKepribadian;
use App\Services\JadwalPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new JadwalPembinaanKepribadianService();
        $this->rules = array (
  'id_pembinaan_kepribadian' => 'nullable',
  'hari' => 'nullable',
  'tanggal' => 'nullable',
  'jam_mulai' => 'nullable',
  'jam_selesai' => 'nullable',
  'id_instruktur' => 'nullable',
  'materi_pembinaan_kepribadian' => 'nullable',
  'foto' => 'nullable',
  'status' => 'nullable',
  'update_terakhir' => 'nullable',
  'update_oleh' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpembinaankepribadian",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="List of JadwalPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jadwal_pk:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_pembinaan_kepribadian,hari,tanggal,jam_mulai,jam_selesai,id_instruktur,materi_pembinaan_kepribadian,foto,status,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian data successfully loaded"),
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
        $jadwalpembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($jadwalpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpembinaankepribadian/dropdown",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="List of JadwalPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_jadwal_pk"];
        $columns[] = "id_jadwal_pk";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = JadwalPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $jadwalpembinaankepribadian = $data->get();

        return response()->json($jadwalpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpembinaankepribadian/schema",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="Schema of JadwalPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian schema successfully loaded"),
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
    'Field' => 'id_jadwal_pk',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'id_pembinaan_kepribadian',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'hari',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'tanggal',
    'Type' => 'DATETIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'jam_mulai',
    'Type' => 'TIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'jam_selesai',
    'Type' => 'TIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'id_instruktur',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'materi_pembinaan_kepribadian',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'foto',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'status',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'update_terakhir',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'update_oleh',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'jadwalpembinaankepribadian', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_jadwal_pk', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/jadwalpembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpembinaankepribadian/{id}",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="JadwalPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="JadwalPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalpembinaankepribadian = JadwalPembinaanKepribadian::where('id_jadwal_pk', $id)->firstOrFail();
        if (!$jadwalpembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($jadwalpembinaankepribadian);
        //$collection = collect($jadwalpembinaankepribadian);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "JadwalPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/jadwalpembinaankepribadian",
     *      tags={"Create JadwalPembinaanKepribadian"},
     *      summary="Create JadwalPembinaanKepribadian",
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
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian successfully created"),
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

        $jadwalpembinaankepribadian = JadwalPembinaanKepribadian::create($request->all());
        if ($jadwalpembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPembinaanKepribadian berhasil ditambahkan.",
                'data' => $jadwalpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/jadwalpembinaankepribadian/{id}",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="Update JadwalPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="JadwalPembinaanKepribadian ID"),
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
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian successfully updated"),
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

        $jadwalpembinaankepribadian = JadwalPembinaanKepribadian::where('id_jadwal_pk', $id)->firstOrFail();
        if ($jadwalpembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPembinaanKepribadian berhasil diubah.",
                'data' => $jadwalpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/jadwalpembinaankepribadian/{id}",
     *      tags={"JadwalPembinaanKepribadian"},
     *      summary="JadwalPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="JadwalPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalpembinaankepribadian = JadwalPembinaanKepribadian::where('id_jadwal_pk', $id)->firstOrFail();

        if ($jadwalpembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPembinaanKepribadian tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}