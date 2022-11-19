<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Services\ProvinsiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new ProvinsiService();
        $this->rules = array (
  'deskripsi' => 'required',
  'id_bps' => 'nullable',
  'id_negara' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/provinsi",
     *      tags={"Provinsi"},
     *      summary="List of Provinsi",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="deskripsi:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="deskripsi,id_bps,id_negara"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi data successfully loaded"),
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
        $provinsi = $this->service->search($data, $request->url());

        return response()->json($provinsi);
    }

    /**
     * @OA\Get(
     *      path="/provinsi/dropdown",
     *      tags={"Provinsi"},
     *      summary="List of Provinsi",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["deskripsi"];
        $columns[] = "id_provinsi";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Provinsi::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $provinsi = $data->get();

        return response()->json($provinsi);
    }

    /**
     * @OA\Get(
     *      path="/provinsi/schema",
     *      tags={"Provinsi"},
     *      summary="Schema of Provinsi",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi schema successfully loaded"),
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
    'Field' => 'id_provinsi',
    'Type' => 'VARCHAR(35)',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'deskripsi',
    'Type' => 'VARCHAR(50)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'status_download',
    'Type' => 'VARCHAR(35)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'id_bps',
    'Type' => 'VARCHAR(4)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'id_negara',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'provinsi', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_provinsi', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/provinsi'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/provinsi/{id}",
     *      tags={"Provinsi"},
     *      summary="Provinsi details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Provinsi ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinsi = Provinsi::where('id_provinsi', $id)->firstOrFail();
        if (!$provinsi->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Provinsi tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($provinsi);
        //$collection = collect($provinsi);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Provinsi ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/provinsi",
     *      tags={"Create Provinsi"},
     *      summary="Create Provinsi",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="deskripsi", ref="#/components/schemas/Provinsi/properties/deskripsi"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="deskripsi", type="array", @OA\Items(example={"Deskripsi field is required."}))
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

        $provinsi = Provinsi::create($request->all());
        if ($provinsi->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Provinsi berhasil ditambahkan.",
                'data' => $provinsi
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Provinsi tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/provinsi/{id}",
     *      tags={"Provinsi"},
     *      summary="Update Provinsi",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Provinsi ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="deskripsi", ref="#/components/schemas/Provinsi/properties/deskripsi"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="deskripsi", type="array", @OA\Items(example={"Deskripsi field is required."}))
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

        $provinsi = Provinsi::where('id_provinsi', $id)->firstOrFail();
        if ($provinsi->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Provinsi berhasil diubah.",
                'data' => $provinsi
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Provinsi tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/provinsi/{id}",
     *      tags={"Provinsi"},
     *      summary="Provinsi Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Provinsi ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Provinsi deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provinsi = Provinsi::where('id_provinsi', $id)->firstOrFail();

        if ($provinsi->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Provinsi berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Provinsi tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
