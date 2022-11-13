<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Services\InstrukturService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrukturController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new InstrukturService();
        $this->rules = array (
  'id_pembinaan_kepribadian' => 'nullable',
  'jenis_instruktur' => 'nullable',
  'id_napi' => 'nullable',
  'id_petugas' => 'nullable',
  'id_mitra' => 'nullable',
  'nama_instruktur' => 'nullable',
  'asal_institusi_instruktur' => 'nullable',
  'no_telp' => 'nullable',
  'email' => 'nullable',
  'keterangan' => 'nullable',
  'update_terakhir' => 'nullable',
  'update_oleh' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/instruktur",
     *      tags={"Instruktur"},
     *      summary="List of Instruktur",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_instruktur:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_pembinaan_kepribadian,jenis_instruktur,id_napi,id_petugas,id_mitra,nama_instruktur,asal_institusi_instruktur,no_telp,email,keterangan,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Instruktur data successfully loaded"),
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
        $instruktur = $this->service->search($data, $request->url());

        return response()->json($instruktur);
    }

    /**
     * @OA\Get(
     *      path="/instruktur/dropdown",
     *      tags={"Instruktur"},
     *      summary="List of Instruktur",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Instruktur data successfully loaded"),
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
        $columns[] = "id_instruktur";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Instruktur::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $instruktur = $data->get();

        return response()->json($instruktur);
    }

    /**
     * @OA\Get(
     *      path="/instruktur/schema",
     *      tags={"Instruktur"},
     *      summary="Schema of Instruktur",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Instruktur schema successfully loaded"),
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
    'Field' => 'id_instruktur',
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
    'Field' => 'jenis_instruktur',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'id_napi',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'id_petugas',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'id_mitra',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'nama_instruktur',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'asal_institusi_instruktur',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'no_telp',
    'Type' => 'VARCHAR(20)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'email',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'keterangan',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'update_terakhir',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  12 => 
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
            'name' => 'instruktur', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_instruktur', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/instruktur'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/instruktur/{id}",
     *      tags={"Instruktur"},
     *      summary="Instruktur details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Instruktur ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Instruktur successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instruktur = Instruktur::where('id_instruktur', $id)->firstOrFail();
        if (!$instruktur->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Instruktur tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($instruktur);
        //$collection = collect($instruktur);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Instruktur ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/instruktur",
     *      tags={"Create Instruktur"},
     *      summary="Create Instruktur",
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
     *              @OA\Property(property="message", type="string", example="Instruktur successfully created"),
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

        $instruktur = Instruktur::create($request->all());
        if ($instruktur->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Instruktur berhasil ditambahkan.",
                'data' => $instruktur
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Instruktur tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/instruktur/{id}",
     *      tags={"Instruktur"},
     *      summary="Update Instruktur",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Instruktur ID"),
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
     *              @OA\Property(property="message", type="string", example="Instruktur successfully updated"),
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

        $instruktur = Instruktur::where('id_instruktur', $id)->firstOrFail();
        if ($instruktur->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Instruktur berhasil diubah.",
                'data' => $instruktur
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Instruktur tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/instruktur/{id}",
     *      tags={"Instruktur"},
     *      summary="Instruktur Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Instruktur ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Instruktur deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruktur = Instruktur::where('id_instruktur', $id)->firstOrFail();

        if ($instruktur->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Instruktur berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Instruktur tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
