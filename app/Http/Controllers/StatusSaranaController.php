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
        $this->rules = array(
            'id_sarana' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'kepemilikan' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'kondisi_baik' => 'required',
            'kondisi_rusak' => 'required',
            'foto' => 'required',
            'keterangan' => 'required',
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
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_sarana:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_sarana,tanggal,status,kepemilikan,jumlah,satuan,kondisi_baik,kondisi_rusak,foto,keterangan"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_sarana"];
        $columns[] = "id";
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
                'Field' => 'id_sarana',
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
                'Field' => 'jumlah',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'satuan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'kondisi_baik',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'kondisi_rusak',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            9 =>
            array(
                'Field' => 'foto',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            10 =>
            array(
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            11 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            12 =>
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
            'name' => 'statussarana',
            'module' => 'lain-lain',
            'primary_key' => 'id',
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
        $statussarana = StatusSarana::where('id', $id)->firstOrFail();
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
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/StatusSarana/properties/id_sarana"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusSarana/properties/tanggal"),
     *              @OA\Property(property="status", ref="#/components/schemas/StatusSarana/properties/status"),
     *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusSarana/properties/kepemilikan"),
     *              @OA\Property(property="jumlah", ref="#/components/schemas/StatusSarana/properties/jumlah"),
     *              @OA\Property(property="satuan", ref="#/components/schemas/StatusSarana/properties/satuan"),
     *              @OA\Property(property="kondisi_baik", ref="#/components/schemas/StatusSarana/properties/kondisi_baik"),
     *              @OA\Property(property="kondisi_rusak", ref="#/components/schemas/StatusSarana/properties/kondisi_rusak"),
     *              @OA\Property(property="foto", ref="#/components/schemas/StatusSarana/properties/foto"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusSarana/properties/keterangan"),
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
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
     *              @OA\Property(property="jumlah", type="array", @OA\Items(example={"Jumlah field is required."})),
     *              @OA\Property(property="satuan", type="array", @OA\Items(example={"Satuan field is required."})),
     *              @OA\Property(property="kondisi_baik", type="array", @OA\Items(example={"Kondisi_baik field is required."})),
     *              @OA\Property(property="kondisi_rusak", type="array", @OA\Items(example={"Kondisi_rusak field is required."})),
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
        $request->merge(['update_at' => date('Y-m-d H:i:s')]);
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
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/StatusSarana/properties/id_sarana"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/StatusSarana/properties/tanggal"),
     *              @OA\Property(property="status", ref="#/components/schemas/StatusSarana/properties/status"),
     *              @OA\Property(property="kepemilikan", ref="#/components/schemas/StatusSarana/properties/kepemilikan"),
     *              @OA\Property(property="jumlah", ref="#/components/schemas/StatusSarana/properties/jumlah"),
     *              @OA\Property(property="satuan", ref="#/components/schemas/StatusSarana/properties/satuan"),
     *              @OA\Property(property="kondisi_baik", ref="#/components/schemas/StatusSarana/properties/kondisi_baik"),
     *              @OA\Property(property="kondisi_rusak", ref="#/components/schemas/StatusSarana/properties/kondisi_rusak"),
     *              @OA\Property(property="foto", ref="#/components/schemas/StatusSarana/properties/foto"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/StatusSarana/properties/keterangan"),
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
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="kepemilikan", type="array", @OA\Items(example={"Kepemilikan field is required."})),
     *              @OA\Property(property="jumlah", type="array", @OA\Items(example={"Jumlah field is required."})),
     *              @OA\Property(property="satuan", type="array", @OA\Items(example={"Satuan field is required."})),
     *              @OA\Property(property="kondisi_baik", type="array", @OA\Items(example={"Kondisi_baik field is required."})),
     *              @OA\Property(property="kondisi_rusak", type="array", @OA\Items(example={"Kondisi_rusak field is required."})),
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
        $request->merge(['update_at' => date('Y-m-d H:i:s')]);
        $this->validate($request, $this->rules);

        $statussarana = StatusSarana::where('id', $id)->firstOrFail();
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
        $statussarana = StatusSarana::where('id', $id)->firstOrFail();

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
