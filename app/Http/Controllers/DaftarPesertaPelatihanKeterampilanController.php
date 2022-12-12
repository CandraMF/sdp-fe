<?php

namespace App\Http\Controllers;

use App\Models\DaftarPesertaPelatihanKeterampilan;
use App\Services\DaftarPesertaPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarPesertaPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new DaftarPesertaPelatihanKeterampilanService();
        $this->rules = array(
            'id_jadwal_pk' => 'required',
            'id_peserta' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
            'verifikasi_oleh' => 'required',
        );
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapelatihanketerampilan",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="List of DaftarPesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jadwal_pk:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jadwal_pk,id_peserta,status,keterangan,verifikasi_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan data successfully loaded"),
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
        $daftarpesertapelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($daftarpesertapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapelatihanketerampilan/dropdown",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="List of DaftarPesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_jadwal_pk"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = DaftarPesertaPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $daftarpesertapelatihanketerampilan = $data->get();

        return response()->json($daftarpesertapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapelatihanketerampilan/schema",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="Schema of DaftarPesertaPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan schema successfully loaded"),
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
                'Field' => 'id_jadwal_pk',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'id_peserta',
                'Type' => 'INT()',
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
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'updated_by',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'verifikasi_oleh',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
        );
        $schema = array(
            'name' => 'daftarpesertapelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/daftarpesertapelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapelatihanketerampilan/{id}",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="DaftarPesertaPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="DaftarPesertaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftarpesertapelatihanketerampilan = DaftarPesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$daftarpesertapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($daftarpesertapelatihanketerampilan);
        //$collection = collect($daftarpesertapelatihanketerampilan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "DaftarPesertaPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/daftarpesertapelatihanketerampilan",
     *      tags={"Create DaftarPesertaPelatihanKeterampilan"},
     *      summary="Create DaftarPesertaPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/id_jadwal_pk"),
     *              @OA\Property(property="id_peserta", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/id_peserta"),
     *              @OA\Property(property="status", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/status"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/keterangan"),
     *              @OA\Property(property="verifikasi_oleh", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/verifikasi_oleh"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", type="array", @OA\Items(example={"Id_jadwal_pk field is required."})),
     *              @OA\Property(property="id_peserta", type="array", @OA\Items(example={"Id_peserta field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."})),
     *              @OA\Property(property="verifikasi_oleh", type="array", @OA\Items(example={"Verifikasi_oleh field is required."}))
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
        $user = Auth::user();
        $request->merge(['updated_by' => $user['preferred_username']);
        $this->validate($request, $this->rules);

        $daftarpesertapelatihanketerampilan = DaftarPesertaPelatihanKeterampilan::create($request->all());
        if ($daftarpesertapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $daftarpesertapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/daftarpesertapelatihanketerampilan/{id}",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="Update DaftarPesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarPesertaPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/id_jadwal_pk"),
     *              @OA\Property(property="id_peserta", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/id_peserta"),
     *              @OA\Property(property="status", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/status"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/keterangan"),
     *              @OA\Property(property="verifikasi_oleh", ref="#/components/schemas/DaftarPesertaPelatihanKeterampilan/properties/verifikasi_oleh"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", type="array", @OA\Items(example={"Id_jadwal_pk field is required."})),
     *              @OA\Property(property="id_peserta", type="array", @OA\Items(example={"Id_peserta field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."})),
     *              @OA\Property(property="keterangan", type="array", @OA\Items(example={"Keterangan field is required."})),
     *              @OA\Property(property="verifikasi_oleh", type="array", @OA\Items(example={"Verifikasi_oleh field is required."}))
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
        $user = Auth::user();
        $request->merge(['updated_by' => $user['preferred_username']);
        $this->validate($request, $this->rules);

        $daftarpesertapelatihanketerampilan = DaftarPesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($daftarpesertapelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPelatihanKeterampilan berhasil diubah.",
                'data' => $daftarpesertapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/daftarpesertapelatihanketerampilan/{id}",
     *      tags={"DaftarPesertaPelatihanKeterampilan"},
     *      summary="DaftarPesertaPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarPesertaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daftarpesertapelatihanketerampilan = DaftarPesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($daftarpesertapelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPelatihanKeterampilan tidak dapat dihapus.",
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
