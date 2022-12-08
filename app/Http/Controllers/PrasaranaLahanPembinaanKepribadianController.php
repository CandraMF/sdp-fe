<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaLahanPembinaanKepribadian;
use App\Services\PrasaranaLahanPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaLahanPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaLahanPembinaanKepribadianService();
        $this->rules = array (
  'id_prasarana_lahan' => 'required',
  'id_pembinaan_kepribadian' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpembinaankepribadian",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="List of PrasaranaLahanPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_lahan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_lahan,id_pembinaan_kepribadian"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian data successfully loaded"),
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
        $prasaranalahanpembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($prasaranalahanpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpembinaankepribadian/dropdown",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="List of PrasaranaLahanPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian data successfully loaded"),
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
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = PrasaranaLahanPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranalahanpembinaankepribadian = $data->get();

        return response()->json($prasaranalahanpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpembinaankepribadian/schema",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="Schema of PrasaranaLahanPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian schema successfully loaded"),
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
    'Field' => 'id_prasarana_lahan',
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
            'name' => 'prasaranalahanpembinaankepribadian', 
            'module' => 'lain-lain', 
            'primary_key' => 'id', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/prasaranalahanpembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpembinaankepribadian/{id}",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="PrasaranaLahanPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaLahanPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranalahanpembinaankepribadian = PrasaranaLahanPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$prasaranalahanpembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranalahanpembinaankepribadian);
        //$collection = collect($prasaranalahanpembinaankepribadian);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaLahanPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranalahanpembinaankepribadian",
     *      tags={"Create PrasaranaLahanPembinaanKepribadian"},
     *      summary="Create PrasaranaLahanPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/PrasaranaLahanPembinaanKepribadian/properties/id_prasarana_lahan"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/PrasaranaLahanPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
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
        $this->validate($request, $this->rules);

        $prasaranalahanpembinaankepribadian = PrasaranaLahanPembinaanKepribadian::create($request->all());
        if ($prasaranalahanpembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPembinaanKepribadian berhasil ditambahkan.",
                'data' => $prasaranalahanpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranalahanpembinaankepribadian/{id}",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="Update PrasaranaLahanPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahanPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/PrasaranaLahanPembinaanKepribadian/properties/id_prasarana_lahan"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/PrasaranaLahanPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
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

        $prasaranalahanpembinaankepribadian = PrasaranaLahanPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($prasaranalahanpembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPembinaanKepribadian berhasil diubah.",
                'data' => $prasaranalahanpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranalahanpembinaankepribadian/{id}",
     *      tags={"PrasaranaLahanPembinaanKepribadian"},
     *      summary="PrasaranaLahanPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahanPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranalahanpembinaankepribadian = PrasaranaLahanPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($prasaranalahanpembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPembinaanKepribadian tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
