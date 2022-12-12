<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaLahanPelatihanKeterampilan;
use App\Services\PrasaranaLahanPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaLahanPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaLahanPelatihanKeterampilanService();
        $this->rules = array (
  'id_prasarana_lahan' => 'required',
  'id_pelatihan_keterampilan' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpelatihanketerampilan",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="List of PrasaranaLahanPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_lahan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_lahan,id_pelatihan_keterampilan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan data successfully loaded"),
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
        $prasaranalahanpelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($prasaranalahanpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpelatihanketerampilan/dropdown",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="List of PrasaranaLahanPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan data successfully loaded"),
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

        $data = PrasaranaLahanPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranalahanpelatihanketerampilan = $data->get();

        return response()->json($prasaranalahanpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpelatihanketerampilan/schema",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="Schema of PrasaranaLahanPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan schema successfully loaded"),
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
    'Field' => 'id_pelatihan_keterampilan',
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
            'name' => 'prasaranalahanpelatihanketerampilan', 
            'module' => 'lain-lain', 
            'primary_key' => 'id', 
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/prasaranalahanpelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranalahanpelatihanketerampilan/{id}",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="PrasaranaLahanPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaLahanPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranalahanpelatihanketerampilan = PrasaranaLahanPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$prasaranalahanpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranalahanpelatihanketerampilan);
        //$collection = collect($prasaranalahanpelatihanketerampilan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaLahanPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranalahanpelatihanketerampilan",
     *      tags={"Create PrasaranaLahanPelatihanKeterampilan"},
     *      summary="Create PrasaranaLahanPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/PrasaranaLahanPelatihanKeterampilan/properties/id_prasarana_lahan"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/PrasaranaLahanPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
*              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."}))
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

        $prasaranalahanpelatihanketerampilan = PrasaranaLahanPelatihanKeterampilan::create($request->all());
        if ($prasaranalahanpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $prasaranalahanpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranalahanpelatihanketerampilan/{id}",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="Update PrasaranaLahanPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahanPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/PrasaranaLahanPelatihanKeterampilan/properties/id_prasarana_lahan"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/PrasaranaLahanPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
*              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."}))
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

        $prasaranalahanpelatihanketerampilan = PrasaranaLahanPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($prasaranalahanpelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPelatihanKeterampilan berhasil diubah.",
                'data' => $prasaranalahanpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranalahanpelatihanketerampilan/{id}",
     *      tags={"PrasaranaLahanPelatihanKeterampilan"},
     *      summary="PrasaranaLahanPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaLahanPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaLahanPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranalahanpelatihanketerampilan = PrasaranaLahanPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($prasaranalahanpelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaLahanPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaLahanPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
