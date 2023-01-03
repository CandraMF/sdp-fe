<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaRuangPembinaanKepribadian;
use App\Services\PrasaranaRuangPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaRuangPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaRuangPembinaanKepribadianService();
        $this->rules = array (
  'id_prasarana_ruang' => 'required',
  'id_pembinaan_kepribadian' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpembinaankepribadian",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="List of PrasaranaRuangPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_ruang:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_ruang,id_pembinaan_kepribadian"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian data successfully loaded"),
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
        $prasaranaruangpembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($prasaranaruangpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpembinaankepribadian/dropdown",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="List of PrasaranaRuangPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian data successfully loaded"),
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

        $data = PrasaranaRuangPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranaruangpembinaankepribadian = $data->get();

        return response()->json($prasaranaruangpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpembinaankepribadian/schema",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="Schema of PrasaranaRuangPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian schema successfully loaded"),
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
    'Extra' => ' AUTO_INCREMENT',
  ),
  1 =>
  array (
    'Field' => 'id_prasarana_ruang',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 =>
  array (
    'Field' => 'id_pembinaan_kepribadian',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 =>
  array (
    'Field' => 'updated_at',
    'Type' => 'TIMESTAMP',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 =>
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
            'name' => 'prasaranaruangpembinaankepribadian',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/prasaranaruangpembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpembinaankepribadian/{id}",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="PrasaranaRuangPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaRuangPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranaruangpembinaankepribadian = PrasaranaRuangPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$prasaranaruangpembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranaruangpembinaankepribadian);
        //$collection = collect($prasaranaruangpembinaankepribadian);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaRuangPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranaruangpembinaankepribadian",
     *      tags={"Create PrasaranaRuangPembinaanKepribadian"},
     *      summary="Create PrasaranaRuangPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/PrasaranaRuangPembinaanKepribadian/properties/id_prasarana_ruang"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/PrasaranaRuangPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
*              @OA\Property(property="id_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_pembinaan_kepribadian field is required."}))
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

        $prasaranaruangpembinaankepribadian = PrasaranaRuangPembinaanKepribadian::create($request->all());
        if ($prasaranaruangpembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPembinaanKepribadian berhasil ditambahkan.",
                'data' => $prasaranaruangpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranaruangpembinaankepribadian/{id}",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="Update PrasaranaRuangPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuangPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/PrasaranaRuangPembinaanKepribadian/properties/id_prasarana_ruang"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/PrasaranaRuangPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
*              @OA\Property(property="id_pembinaan_kepribadian", type="array", @OA\Items(example={"Id_pembinaan_kepribadian field is required."}))
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

        $prasaranaruangpembinaankepribadian = PrasaranaRuangPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($prasaranaruangpembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPembinaanKepribadian berhasil diubah.",
                'data' => $prasaranaruangpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranaruangpembinaankepribadian/{id}",
     *      tags={"PrasaranaRuangPembinaanKepribadian"},
     *      summary="PrasaranaRuangPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuangPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranaruangpembinaankepribadian = PrasaranaRuangPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($prasaranaruangpembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPembinaanKepribadian tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
