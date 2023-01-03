<?php

namespace App\Http\Controllers;

use App\Models\SaranaPembinaanKepribadian;
use App\Services\SaranaPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranaPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new SaranaPembinaanKepribadianService();
        $this->rules = array (
  'id_sarana' => 'required',
  'id_pembinaan_kepribadian' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/saranapembinaankepribadian",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="List of SaranaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_sarana:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_sarana,id_pembinaan_kepribadian"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian data successfully loaded"),
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
        $saranapembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($saranapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/saranapembinaankepribadian/dropdown",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="List of SaranaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_sarana"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = SaranaPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $saranapembinaankepribadian = $data->get();

        return response()->json($saranapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/saranapembinaankepribadian/schema",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="Schema of SaranaPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian schema successfully loaded"),
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
    'Field' => 'id_sarana',
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
            'name' => 'saranapembinaankepribadian',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/saranapembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/saranapembinaankepribadian/{id}",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="SaranaPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="SaranaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saranapembinaankepribadian = SaranaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$saranapembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($saranapembinaankepribadian);
        //$collection = collect($saranapembinaankepribadian);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "SaranaPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/saranapembinaankepribadian",
     *      tags={"Create SaranaPembinaanKepribadian"},
     *      summary="Create SaranaPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/SaranaPembinaanKepribadian/properties/id_sarana"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/SaranaPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
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

        $saranapembinaankepribadian = SaranaPembinaanKepribadian::create($request->all());
        if ($saranapembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPembinaanKepribadian berhasil ditambahkan.",
                'data' => $saranapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/saranapembinaankepribadian/{id}",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="Update SaranaPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="SaranaPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/SaranaPembinaanKepribadian/properties/id_sarana"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/SaranaPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
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

        $saranapembinaankepribadian = SaranaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($saranapembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPembinaanKepribadian berhasil diubah.",
                'data' => $saranapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/saranapembinaankepribadian/{id}",
     *      tags={"SaranaPembinaanKepribadian"},
     *      summary="SaranaPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="SaranaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saranapembinaankepribadian = SaranaPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($saranapembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPembinaanKepribadian tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
