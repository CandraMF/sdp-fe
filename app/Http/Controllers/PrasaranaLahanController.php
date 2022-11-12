<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaLahan;
use App\Services\PrasaranaLahanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaLahanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaLahanService();
        $this->rules = array (
  'id_jenis_prasarana_lahan' => 'nullable',
  'nama_prasarana_lahan' => 'nullable',
  'id_upt' => 'nullable',
  'tgl_pengadaan' => 'nullable',
  'keterangan' => 'nullable',
  'update_terakhir' => 'nullable',
  'update_oleh' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahan",
     *      tags={"PrasaranaLahan"},
     *      summary="List of PrasaranaLahan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_lahan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_prasarana_lahan,nama_prasarana_lahan,id_upt,tgl_pengadaan,keterangan,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan data successfully loaded"),
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
        $prasaranalahan = $this->service->search($data, $request->url());

        return response()->json($prasaranalahan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahan/dropdown",
     *      tags={"PrasaranaLahan"},
     *      summary="List of PrasaranaLahan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_prasarana_lahan"];
        $columns[] = "id_prasarana_lahan";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = PrasaranaLahan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranalahan = $data->get();

        return response()->json($prasaranalahan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahan/schema",
     *      tags={"PrasaranaLahan"},
     *      summary="Schema of PrasaranaLahan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan schema successfully loaded"),
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
    'Field' => 'id_prasarana_lahan',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'id_jenis_prasarana_lahan',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'nama_prasarana_lahan',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'id_upt',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'tgl_pengadaan',
    'Type' => 'DATETIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'keterangan',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'update_terakhir',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
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
            'name' => 'prasaranalahan', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_prasarana_lahan', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/prasaranalahan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahan/{id}",
     *      tags={"PrasaranaLahan"},
     *      summary="PrasaranaLahan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaLahan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranalahan = PrasaranaLahan::where('id_prasarana_lahan', $id)->firstOrFail();
        if (!$prasaranalahan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranalahan);
        //$collection = collect($prasaranalahan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaLahan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranalahan",
     *      tags={"Create PrasaranaLahan"},
     *      summary="Create PrasaranaLahan",
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
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan successfully created"),
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

        $prasaranalahan = PrasaranaLahan::create($request->all());
        if ($prasaranalahan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahan berhasil ditambahkan.",
                'data' => $prasaranalahan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranalahan/{id}",
     *      tags={"PrasaranaLahan"},
     *      summary="Update PrasaranaLahan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahan ID"),
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
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan successfully updated"),
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

        $prasaranalahan = PrasaranaLahan::where('id_prasarana_lahan', $id)->firstOrFail();
        if ($prasaranalahan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahan berhasil diubah.",
                'data' => $prasaranalahan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahan tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranalahan/{id}",
     *      tags={"PrasaranaLahan"},
     *      summary="PrasaranaLahan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranalahan = PrasaranaLahan::where('id_prasarana_lahan', $id)->firstOrFail();

        if ($prasaranalahan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahan tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
