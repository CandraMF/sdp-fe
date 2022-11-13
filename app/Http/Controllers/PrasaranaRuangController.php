<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaRuang;
use App\Services\PrasaranaRuangService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaRuangController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaRuangService();
        $this->rules = array (
  'id_jenis_prasarana_ruang' => 'nullable',
  'nama_prasarana_ruang' => 'nullable',
  'id_upt' => 'nullable',
  'tgl_pengadaan' => 'nullable',
  'keterangan' => 'nullable',
  'update_terakhir' => 'nullable',
  'update_oleh' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruang",
     *      tags={"PrasaranaRuang"},
     *      summary="List of PrasaranaRuang",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_ruang:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_prasarana_ruang,nama_prasarana_ruang,id_upt,tgl_pengadaan,keterangan,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang data successfully loaded"),
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
        $prasaranaruang = $this->service->search($data, $request->url());

        return response()->json($prasaranaruang);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruang/dropdown",
     *      tags={"PrasaranaRuang"},
     *      summary="List of PrasaranaRuang",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang data successfully loaded"),
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
        $columns[] = "id_prasarana_ruang";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = PrasaranaRuang::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranaruang = $data->get();

        return response()->json($prasaranaruang);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruang/schema",
     *      tags={"PrasaranaRuang"},
     *      summary="Schema of PrasaranaRuang",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang schema successfully loaded"),
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
    'Field' => 'id_prasarana_ruang',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'id_jenis_prasarana_ruang',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'nama_prasarana_ruang',
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
            'name' => 'prasaranaruang', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_prasarana_ruang', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/prasaranaruang'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruang/{id}",
     *      tags={"PrasaranaRuang"},
     *      summary="PrasaranaRuang details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaRuang ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranaruang = PrasaranaRuang::where('id_prasarana_ruang', $id)->firstOrFail();
        if (!$prasaranaruang->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuang tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranaruang);
        //$collection = collect($prasaranaruang);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaRuang ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranaruang",
     *      tags={"Create PrasaranaRuang"},
     *      summary="Create PrasaranaRuang",
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
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang successfully created"),
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

        $prasaranaruang = PrasaranaRuang::create($request->all());
        if ($prasaranaruang->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuang berhasil ditambahkan.",
                'data' => $prasaranaruang
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuang tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranaruang/{id}",
     *      tags={"PrasaranaRuang"},
     *      summary="Update PrasaranaRuang",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuang ID"),
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
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang successfully updated"),
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

        $prasaranaruang = PrasaranaRuang::where('id_prasarana_ruang', $id)->firstOrFail();
        if ($prasaranaruang->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuang berhasil diubah.",
                'data' => $prasaranaruang
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuang tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranaruang/{id}",
     *      tags={"PrasaranaRuang"},
     *      summary="PrasaranaRuang Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuang ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuang deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranaruang = PrasaranaRuang::where('id_prasarana_ruang', $id)->firstOrFail();

        if ($prasaranaruang->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuang berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuang tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}