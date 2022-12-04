<?php

namespace App\Http\Controllers;

use App\Models\Sarana;
use App\Services\SaranaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranaController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new SaranaService();
        $this->rules = array(
            'id_jenis_sarana' => 'required',
            'nama_sarana' => 'required',
            'id_upt' => 'required',
            'tgl_pengadaan' => 'required',
            'keterangan' => 'required',
        );
    }

    /**
     * @OA\Get(
     *      path="/sarana",
     *      tags={"Sarana"},
     *      summary="List of Sarana",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jenis_sarana:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jenis_sarana,nama_sarana,id_upt,tgl_pengadaan,keterangan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana data successfully loaded"),
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
        $sarana = $this->service->search($data, $request->url());

        return response()->json($sarana);
    }

    /**
     * @OA\Get(
     *      path="/sarana/dropdown",
     *      tags={"Sarana"},
     *      summary="List of Sarana",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_jenis_sarana"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Sarana::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $sarana = $data->get();

        return response()->json($sarana);
    }

    /**
     * @OA\Get(
     *      path="/sarana/schema",
     *      tags={"Sarana"},
     *      summary="Schema of Sarana",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana schema successfully loaded"),
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
                'Field' => 'id_jenis_sarana',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'nama_sarana',
                'Type' => 'VARCHAR(100)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'id_upt',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'tgl_pengadaan',
                'Type' => 'DATETIME',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
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
            'name' => 'sarana',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/sarana'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/sarana/{id}",
     *      tags={"Sarana"},
     *      summary="Sarana details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Sarana ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $defaultColumn = ['sarana.id', 'sarana.nama_sarana', 'sarana.id_jenis_sarana', 'daftar_referensi.deskripsi as jenis_sarana', 'upt.uraian as nmupt', 'sarana.tgl_pengadaan'];
        $sarana = Sarana::query();
        $sarana = $sarana->select($defaultColumn);
        $sarana = $sarana->join('daftar_referensi', 'sarana.id_jenis_sarana', '=', 'daftar_referensi.id_lookup');
        $sarana = $sarana->join('upt', 'sarana.id_upt', '=', 'upt.id_upt');
        $sarana = $sarana->where('sarana.id', $id)->firstOrFail();

        if (!$sarana->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Sarana tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($sarana);
        //$collection = collect($sarana);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Sarana ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/sarana",
     *      tags={"Create Sarana"},
     *      summary="Create Sarana",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jenis_sarana", ref="#/components/schemas/Sarana/properties/id_jenis_sarana"),
     *              @OA\Property(property="nama_sarana", ref="#/components/schemas/Sarana/properties/nama_sarana"),
     *              @OA\Property(property="id_upt", ref="#/components/schemas/Sarana/properties/id_upt"),
     *              @OA\Property(property="tgl_pengadaan", ref="#/components/schemas/Sarana/properties/tgl_pengadaan"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/Sarana/properties/keterangan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_jenis_sarana", type="array", @OA\Items(example={"Id_jenis_sarana field is required."})),
     *              @OA\Property(property="nama_sarana", type="array", @OA\Items(example={"Nama_sarana field is required."})),
     *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
     *              @OA\Property(property="tgl_pengadaan", type="array", @OA\Items(example={"Tgl_pengadaan field is required."})),
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

        $sarana = Sarana::create($request->all());
        if ($sarana->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Sarana berhasil ditambahkan.",
                'data' => $sarana
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Sarana tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/sarana/{id}",
     *      tags={"Sarana"},
     *      summary="Update Sarana",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Sarana ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jenis_sarana", ref="#/components/schemas/Sarana/properties/id_jenis_sarana"),
     *              @OA\Property(property="nama_sarana", ref="#/components/schemas/Sarana/properties/nama_sarana"),
     *              @OA\Property(property="id_upt", ref="#/components/schemas/Sarana/properties/id_upt"),
     *              @OA\Property(property="tgl_pengadaan", ref="#/components/schemas/Sarana/properties/tgl_pengadaan"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/Sarana/properties/keterangan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_jenis_sarana", type="array", @OA\Items(example={"Id_jenis_sarana field is required."})),
     *              @OA\Property(property="nama_sarana", type="array", @OA\Items(example={"Nama_sarana field is required."})),
     *              @OA\Property(property="id_upt", type="array", @OA\Items(example={"Id_upt field is required."})),
     *              @OA\Property(property="tgl_pengadaan", type="array", @OA\Items(example={"Tgl_pengadaan field is required."})),
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

        $sarana = Sarana::where('id', $id)->firstOrFail();
        if ($sarana->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Sarana berhasil diubah.",
                'data' => $sarana
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Sarana tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/sarana/{id}",
     *      tags={"Sarana"},
     *      summary="Sarana Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Sarana ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sarana deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sarana = Sarana::where('id', $id)->firstOrFail();

        if ($sarana->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Sarana berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Sarana tidak dapat dihapus.",
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
