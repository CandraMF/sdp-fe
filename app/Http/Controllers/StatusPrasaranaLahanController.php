<?php

namespace App\Http\Controllers;

use App\Models\StatusPrasaranaLahan;
use App\Services\StatusPrasaranaLahanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusPrasaranaLahanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new StatusPrasaranaLahanService();
        $this->rules = array(
            'id_prasarana_lahan' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'kepemilikan' => 'required',
            'luas_dipakai' => 'required',
            'lahan_tidur' => 'required',
            'satuan' => 'required',
            'foto' => 'required',
            'keterangan' => 'required',
        );
    }

    /**
     * @OA\Get(
     *      path="/statusprasaranalahan",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="List of StatusPrasaranaLahan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_prasarana_lahan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_lahan,tanggal,status,kepemilikan,luas_dipakai,lahan_tidur,satuan,foto,keterangan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan data successfully loaded"),
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
        $statusprasaranalahan = $this->service->search($data, $request->url());

        return response()->json($statusprasaranalahan);
    }

    /**
     * @OA\Get(
     *      path="/statusprasaranalahan/dropdown",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="List of StatusPrasaranaLahan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan data successfully loaded"),
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

        $data = StatusPrasaranaLahan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $statusprasaranalahan = $data->get();

        return response()->json($statusprasaranalahan);
    }

    /**
     * @OA\Get(
     *      path="/statusprasaranalahan/schema",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="Schema of StatusPrasaranaLahan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan schema successfully loaded"),
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
        $fields = array(
            0 =>
            array(
                'Field' => 'id',
                'Type' => 'BIGINT()',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => ' UNSIGNED AUTO_INCREMENT',
            ),
            1 =>
            array(
                'Field' => 'id_prasarana_lahan',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'tanggal',
                'Type' => 'DATETIME',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'status',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'kepemilikan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'luas_dipakai',
                'Type' => 'DECIMAL(, 6)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'lahan_tidur',
                'Type' => 'DECIMAL(, 6)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'satuan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'foto',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            9 =>
            array(
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            10 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            11 =>
            array(
                'Field' => 'updated_by',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
        );
        $schema = array(
            'name' => 'statusprasaranalahan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/statusprasaranalahan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/statusprasaranalahan/{id}",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="StatusPrasaranaLahan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="StatusPrasaranaLahan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statusprasaranalahan = StatusPrasaranaLahan::where('id', $id)->firstOrFail();

        if (!$statusprasaranalahan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "StatusPrasaranaLahan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($statusprasaranalahan);
        //$collection = collect($statusprasaranalahan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "StatusPrasaranaLahan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/statusprasaranalahan",
     *      tags={"Create StatusPrasaranaLahan"},
     *      summary="Create StatusPrasaranaLahan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/StatusPrasaranaLahan/properties/id_prasarana_lahan"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusPrasaranaLahan/properties/tanggal"),
     *              @OA\Property(property="status", ref="#/components/schemas/StatusPrasaranaLahan/properties/status"),
     *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusPrasaranaLahan/properties/kepemilikan"),
     *              @OA\Property(property="luas_dipakai", ref="#/components/schemas/StatusPrasaranaLahan/properties/luas_dipakai"),
     *              @OA\Property(property="lahan_tidur", ref="#/components/schemas/StatusPrasaranaLahan/properties/lahan_tidur"),
     *              @OA\Property(property="satuan", ref="#/components/schemas/StatusPrasaranaLahan/properties/satuan"),
     *              @OA\Property(property="foto", ref="#/components/schemas/StatusPrasaranaLahan/properties/foto"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusPrasaranaLahan/properties/keterangan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
     *              @OA\Property(property="luas_dipakai", type="array", @OA\Items(example={"Luas_dipakai field is required."})),
     *              @OA\Property(property="lahan_tidur", type="array", @OA\Items(example={"Lahan_tidur field is required."})),
     *              @OA\Property(property="satuan", type="array", @OA\Items(example={"Satuan field is required."})),
     *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
     *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."}))
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
        $this->validate($request, $this->rules);

        $statusprasaranalahan = StatusPrasaranaLahan::create($request->all());
        if ($statusprasaranalahan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "StatusPrasaranaLahan berhasil ditambahkan.",
                'data' => $statusprasaranalahan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusPrasaranaLahan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/statusprasaranalahan/{id}",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="Update StatusPrasaranaLahan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusPrasaranaLahan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", ref="#/components/schemas/StatusPrasaranaLahan/properties/id_prasarana_lahan"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusPrasaranaLahan/properties/tanggal"),
     *              @OA\Property(property="status", ref="#/components/schemas/StatusPrasaranaLahan/properties/status"),
     *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusPrasaranaLahan/properties/kepemilikan"),
     *              @OA\Property(property="luas_dipakai", ref="#/components/schemas/StatusPrasaranaLahan/properties/luas_dipakai"),
     *              @OA\Property(property="lahan_tidur", ref="#/components/schemas/StatusPrasaranaLahan/properties/lahan_tidur"),
     *              @OA\Property(property="satuan", ref="#/components/schemas/StatusPrasaranaLahan/properties/satuan"),
     *              @OA\Property(property="foto", ref="#/components/schemas/StatusPrasaranaLahan/properties/foto"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusPrasaranaLahan/properties/keterangan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_prasarana_lahan", type="array", @OA\Items(example={"Id_prasarana_lahan field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
     *              @OA\Property(property="luas_dipakai", type="array", @OA\Items(example={"Luas_dipakai field is required."})),
     *              @OA\Property(property="lahan_tidur", type="array", @OA\Items(example={"Lahan_tidur field is required."})),
     *              @OA\Property(property="satuan", type="array", @OA\Items(example={"Satuan field is required."})),
     *              @OA\Property(property="foto", type="array", @OA\Items(example={"Foto field is required."})),
     *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."}))
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
        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
        $this->validate($request, $this->rules);

        $statusprasaranalahan = StatusPrasaranaLahan::where('id', $id)->firstOrFail();
        if ($statusprasaranalahan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "StatusPrasaranaLahan berhasil diubah.",
                'data' => $statusprasaranalahan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusPrasaranaLahan tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/statusprasaranalahan/{id}",
     *      tags={"StatusPrasaranaLahan"},
     *      summary="StatusPrasaranaLahan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="StatusPrasaranaLahan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="StatusPrasaranaLahan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statusprasaranalahan = StatusPrasaranaLahan::where('id', $id)->firstOrFail();

        if ($statusprasaranalahan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "StatusPrasaranaLahan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "StatusPrasaranaLahan tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }

    public function exportExcel(Request $request)
    {
        $data = $request->toArray();
        $export = $this->service->exportExcel($data);

        return $export;
    }


    public function exportPdf(Request $request)
    {
        $data = $request->toArray();
        $export = $this->service->printPDF($data);

        return $export;
    }
}
