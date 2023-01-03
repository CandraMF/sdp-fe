<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaRuangPelatihanKeterampilan;
use App\Services\PrasaranaRuangPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrasaranaRuangPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PrasaranaRuangPelatihanKeterampilanService();
        $this->rules = array (
  'id_prasarana_ruang' => 'required',
  'id_pelatihan_keterampilan' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpelatihanketerampilan",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="List of PrasaranaRuangPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_ruang:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_ruang,id_pelatihan_keterampilan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan data successfully loaded"),
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
        $prasaranaruangpelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($prasaranaruangpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpelatihanketerampilan/dropdown",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="List of PrasaranaRuangPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan data successfully loaded"),
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

        $data = PrasaranaRuangPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $prasaranaruangpelatihanketerampilan = $data->get();

        return response()->json($prasaranaruangpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpelatihanketerampilan/schema",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="Schema of PrasaranaRuangPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan schema successfully loaded"),
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
            'name' => 'prasaranaruangpelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/prasaranaruangpelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/prasaranaruangpelatihanketerampilan/{id}",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="PrasaranaRuangPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PrasaranaRuangPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prasaranaruangpelatihanketerampilan = PrasaranaRuangPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$prasaranaruangpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($prasaranaruangpelatihanketerampilan);
        //$collection = collect($prasaranaruangpelatihanketerampilan);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "PrasaranaRuangPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/prasaranaruangpelatihanketerampilan",
     *      tags={"Create PrasaranaRuangPelatihanKeterampilan"},
     *      summary="Create PrasaranaRuangPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/PrasaranaRuangPelatihanKeterampilan/properties/id_prasarana_ruang"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/PrasaranaRuangPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
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
        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
        // $user = Auth::user();
        $request->merge(['updated_by' => 'admin']);

        $this->validate($request, $this->rules);

        $prasaranaruangpelatihanketerampilan = PrasaranaRuangPelatihanKeterampilan::create($request->all());
        if ($prasaranaruangpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $prasaranaruangpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/prasaranaruangpelatihanketerampilan/{id}",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="Update PrasaranaRuangPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuangPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", ref="#/components/schemas/PrasaranaRuangPelatihanKeterampilan/properties/id_prasarana_ruang"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/PrasaranaRuangPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_ruang", type="array", @OA\Items(example={"Id_prasarana_ruang field is required."})),
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

        $prasaranaruangpelatihanketerampilan = PrasaranaRuangPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($prasaranaruangpelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPelatihanKeterampilan berhasil diubah.",
                'data' => $prasaranaruangpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/prasaranaruangpelatihanketerampilan/{id}",
     *      tags={"PrasaranaRuangPelatihanKeterampilan"},
     *      summary="PrasaranaRuangPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PrasaranaRuangPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PrasaranaRuangPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prasaranaruangpelatihanketerampilan = PrasaranaRuangPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($prasaranaruangpelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PrasaranaRuangPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PrasaranaRuangPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
