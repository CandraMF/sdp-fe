<?php

namespace App\Http\Controllers;

use App\Models\StatusSarana;
use App\Services\StatusSaranaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusSaranaController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new StatusSaranaService();
        $this->rules = array (
  'id_sarana' => 'nullable',
  'tahun' => 'nullable',
  'bulan' => 'nullable',
  'status' => 'nullable',
  'kepemilkan' => 'nullable',
  'jumlah' => 'nullable',
  'satuan' => 'nullable',
  'kondisi_baik' => 'nullable',
  'kondisi_rusak' => 'nullable',
  'foto' => 'nullable',
  'keterangan' => 'nullable',
  'update_terakhir' => 'nullable',
  'update_oleh' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/statussarana",
     *      tags={"StatusSarana"},
     *      summary="List of StatusSarana",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_status_sarana:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_sarana,tahun,bulan,status,kepemilkan,jumlah,satuan,kondisi_baik,kondisi_rusak,foto,keterangan,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusSarana data successfully loaded"),
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
        $statussarana = $this->service->search($data, $request->url());

        return response()->json($statussarana);
    }

    /**
     * @OA\Get(
     *      path="/statussarana/dropdown",
     *      tags={"StatusSarana"},
     *      summary="List of StatusSarana",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusSarana data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_status_sarana"];
        $columns[] = "id_status_sarana";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = StatusSarana::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $statussarana = $data->get();

        return response()->json($statussarana);
    }

    /**
     * @OA\Get(
     *      path="/statussarana/schema",
     *      tags={"StatusSarana"},
     *      summary="Schema of StatusSarana",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusSarana schema successfully loaded"),
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
    'Field' => 'id_status_sarana',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'id_sarana',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'tahun',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'bulan',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'status',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'kepemilkan',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'jumlah',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'satuan',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'kondisi_baik',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'kondisi_rusak',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'foto',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'keterangan',
    'Type' => 'VARCHAR(200)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  12 => 
  array (
    'Field' => 'update_terakhir',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  13 => 
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
            'name' => 'statussarana', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_status_sarana', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/statussarana'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/statussarana/{id}",
     *      tags={"StatusSarana"},
     *      summary="StatusSarana details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="StatusSarana ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusSarana successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statussarana = StatusSarana::where('id_status_sarana', $id)->firstOrFail();
        if (!$statussarana->exists) {
            return response()->json([
                'status' => 500,
                'message' => "StatusSarana tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($statussarana);
        //$collection = collect($statussarana);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "StatusSarana ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/statussarana",
     *      tags={"Create StatusSarana"},
     *      summary="Create StatusSarana",
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
     *              @OA\Property(property="message", type="string", example="StatusSarana successfully created"),
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

        $statussarana = StatusSarana::create($request->all());
        if ($statussarana->exists) {
            return response()->json([
                'status' => 200,
                'message' => "StatusSarana berhasil ditambahkan.",
                'data' => $statussarana
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusSarana tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/statussarana/{id}",
     *      tags={"StatusSarana"},
     *      summary="Update StatusSarana",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusSarana ID"),
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
     *              @OA\Property(property="message", type="string", example="StatusSarana successfully updated"),
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

        $statussarana = StatusSarana::where('id_status_sarana', $id)->firstOrFail();
        if ($statussarana->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "StatusSarana berhasil diubah.",
                'data' => $statussarana
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusSarana tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/statussarana/{id}",
     *      tags={"StatusSarana"},
     *      summary="StatusSarana Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusSarana ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusSarana deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statussarana = StatusSarana::where('id_status_sarana', $id)->firstOrFail();

        if ($statussarana->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "StatusSarana berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusSarana tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
