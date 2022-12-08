<?php

namespace App\Http\Controllers;

use App\Models\InstrukturPembinaanKepribadian;
use App\Services\InstrukturPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrukturPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new InstrukturPembinaanKepribadianService();
        $this->rules = array (
  'id_instruktur' => 'required',
  'id_pembinaan_kepribadian' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpembinaankepribadian",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="List of InstrukturPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_instruktur:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_instruktur,id_pembinaan_kepribadian"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian data successfully loaded"),
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
        $instrukturpembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($instrukturpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpembinaankepribadian/dropdown",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="List of InstrukturPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_instruktur"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = InstrukturPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $instrukturpembinaankepribadian = $data->get();

        return response()->json($instrukturpembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpembinaankepribadian/schema",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="Schema of InstrukturPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian schema successfully loaded"),
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
    'Field' => 'id_instruktur',
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
            'name' => 'instrukturpembinaankepribadian', 
            'module' => 'lain-lain', 
            'primary_key' => 'id', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/instrukturpembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpembinaankepribadian/{id}",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="InstrukturPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="InstrukturPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instrukturpembinaankepribadian = InstrukturPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$instrukturpembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($instrukturpembinaankepribadian);
        //$collection = collect($instrukturpembinaankepribadian);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "InstrukturPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/instrukturpembinaankepribadian",
     *      tags={"Create InstrukturPembinaanKepribadian"},
     *      summary="Create InstrukturPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/InstrukturPembinaanKepribadian/properties/id_instruktur"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/InstrukturPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
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

        $instrukturpembinaankepribadian = InstrukturPembinaanKepribadian::create($request->all());
        if ($instrukturpembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPembinaanKepribadian berhasil ditambahkan.",
                'data' => $instrukturpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/instrukturpembinaankepribadian/{id}",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="Update InstrukturPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="InstrukturPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/InstrukturPembinaanKepribadian/properties/id_instruktur"),
*              @OA\Property(property="id_pembinaan_kepribadian", ref="#/components/schemas/InstrukturPembinaanKepribadian/properties/id_pembinaan_kepribadian"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
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

        $instrukturpembinaankepribadian = InstrukturPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($instrukturpembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPembinaanKepribadian berhasil diubah.",
                'data' => $instrukturpembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/instrukturpembinaankepribadian/{id}",
     *      tags={"InstrukturPembinaanKepribadian"},
     *      summary="InstrukturPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="InstrukturPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrukturpembinaankepribadian = InstrukturPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($instrukturpembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPembinaanKepribadian tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
