<?php

namespace App\Http\Controllers;

use App\Models\DaftarPesertaPembinaanKepribadian;
use App\Services\DaftarPesertaPembinaanKepribadianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarPesertaPembinaanKepribadianController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new DaftarPesertaPembinaanKepribadianService();
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
     *      path="/daftarpesertapembinaankepribadian",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="List of DaftarPesertaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_jadwal_pk:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_jadwal_pk,id_peserta,status,keterangan,verifikasi_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian data successfully loaded"),
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
        $daftarpesertapembinaankepribadian = $this->service->search($data, $request->url());

        return response()->json($daftarpesertapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapembinaankepribadian/dropdown",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="List of DaftarPesertaPembinaanKepribadian",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian data successfully loaded"),
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

        $data = DaftarPesertaPembinaanKepribadian::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $daftarpesertapembinaankepribadian = $data->get();

        return response()->json($daftarpesertapembinaankepribadian);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapembinaankepribadian/schema",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="Schema of DaftarPesertaPembinaanKepribadian",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian schema successfully loaded"),
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
            'name' => 'daftarpesertapembinaankepribadian',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/daftarpesertapembinaankepribadian'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/daftarpesertapembinaankepribadian/{id}",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="DaftarPesertaPembinaanKepribadian details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="DaftarPesertaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftarpesertapembinaankepribadian = DaftarPesertaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if (!$daftarpesertapembinaankepribadian->exists) {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPembinaanKepribadian tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($daftarpesertapembinaankepribadian);
        //$collection = collect($daftarpesertapembinaankepribadian);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "DaftarPesertaPembinaanKepribadian ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/daftarpesertapembinaankepribadian",
     *      tags={"Create DaftarPesertaPembinaanKepribadian"},
     *      summary="Create DaftarPesertaPembinaanKepribadian",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/id_jadwal_pk"),
     *              @OA\Property(property="id_peserta", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/id_peserta"),
     *              @OA\Property(property="status", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/status"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/keterangan"),
     *              @OA\Property(property="verifikasi_oleh", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/verifikasi_oleh"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian successfully created"),
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
        $request->merge(['updated_by' => 'admin']);
        $this->validate($request, $this->rules);

        $daftarpesertapembinaankepribadian = DaftarPesertaPembinaanKepribadian::create($request->all());
        if ($daftarpesertapembinaankepribadian->exists) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPembinaanKepribadian berhasil ditambahkan.",
                'data' => $daftarpesertapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPembinaanKepribadian tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/daftarpesertapembinaankepribadian/{id}",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="Update DaftarPesertaPembinaanKepribadian",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarPesertaPembinaanKepribadian ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_jadwal_pk", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/id_jadwal_pk"),
     *              @OA\Property(property="id_peserta", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/id_peserta"),
     *              @OA\Property(property="status", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/status"),
     *              @OA\Property(property="keterangan", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/keterangan"),
     *              @OA\Property(property="verifikasi_oleh", ref="#/components/schemas/DaftarPesertaPembinaanKepribadian/properties/verifikasi_oleh"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian successfully updated"),
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
        $request->merge(['updated_by' => 'admin']);
        $this->validate($request, $this->rules);

        $daftarpesertapembinaankepribadian = DaftarPesertaPembinaanKepribadian::where('id', $id)->firstOrFail();
        if ($daftarpesertapembinaankepribadian->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPembinaanKepribadian berhasil diubah.",
                'data' => $daftarpesertapembinaankepribadian
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPembinaanKepribadian tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/daftarpesertapembinaankepribadian/{id}",
     *      tags={"DaftarPesertaPembinaanKepribadian"},
     *      summary="DaftarPesertaPembinaanKepribadian Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarPesertaPembinaanKepribadian ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarPesertaPembinaanKepribadian deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daftarpesertapembinaankepribadian = DaftarPesertaPembinaanKepribadian::where('id', $id)->firstOrFail();

        if ($daftarpesertapembinaankepribadian->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarPesertaPembinaanKepribadian berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarPesertaPembinaanKepribadian tidak dapat dihapus.",
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
