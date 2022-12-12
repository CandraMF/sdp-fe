<?php

namespace App\Http\Controllers;

use App\Models\PesertaPelatihanKeterampilan;
use App\Services\PesertaPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PesertaPelatihanKeterampilanService();
        $this->rules = array(
            'id_daftar_peserta_pelatihan_keterampilan' => 'required',
            'id_wbp' => 'required',
            'kehadiran' => 'required',
            'no_sertifikat' => 'required',
            'file_sertifikat' => 'required',
            'nilai' => 'required',
            'predikat' => 'required',
        );
    }

    /**
     * @OA\Get(
     *      path="/pesertapelatihanketerampilan",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="List of PesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_daftar_peserta_pelatihan_keterampilan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_daftar_peserta_pelatihan_keterampilan,id_wbp,kehadiran,no_sertifikat,file_sertifikat,nilai,predikat"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan data successfully loaded"),
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
        $pesertapelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($pesertapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/pesertapelatihanketerampilan/dropdown",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="List of PesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_daftar_peserta_pelatihan_keterampilan"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = PesertaPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $pesertapelatihanketerampilan = $data->get();

        return response()->json($pesertapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/pesertapelatihanketerampilan/schema",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="Schema of PesertaPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan schema successfully loaded"),
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
                'Field' => 'id_daftar_peserta_pelatihan_keterampilan',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'id_wbp',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'kehadiran',
                'Type' => 'TINYINT(1)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'no_sertifikat',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'file_sertifikat',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'nilai',
                'Type' => 'DECIMAL(, 3)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'predikat',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            9 =>
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
            'name' => 'pesertapelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/pesertapelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/pesertapelatihanketerampilan/{id}",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="PesertaPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="PesertaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesertapelatihanketerampilan = PesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$pesertapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($pesertapelatihanketerampilan);
        //$collection = collect($pesertapelatihanketerampilan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "PesertaPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/pesertapelatihanketerampilan",
     *      tags={"Create PesertaPelatihanKeterampilan"},
     *      summary="Create PesertaPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_daftar_peserta_pelatihan_keterampilan", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/id_daftar_peserta_pelatihan_keterampilan"),
     *              @OA\Property(property="id_wbp", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/id_wbp"),
     *              @OA\Property(property="kehadiran", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/kehadiran"),
     *              @OA\Property(property="no_sertifikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/no_sertifikat"),
     *              @OA\Property(property="file_sertifikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/file_sertifikat"),
     *              @OA\Property(property="nilai", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/nilai"),
     *              @OA\Property(property="predikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/predikat"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_daftar_peserta_pelatihan_keterampilan", type="array", @OA\Items(example={"id_daftar_peserta_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="id_wbp", type="array", @OA\Items(example={"Id_wbp field is required."})),
     *              @OA\Property(property="kehadiran", type="array", @OA\Items(example={"Kehadiran field is required."})),
     *              @OA\Property(property="no_sertifikat", type="array", @OA\Items(example={"No_sertifikat field is required."})),
     *              @OA\Property(property="file_sertifikat", type="array", @OA\Items(example={"File_sertifikat field is required."})),
     *              @OA\Property(property="nilai", type="array", @OA\Items(example={"Nilai field is required."})),
     *              @OA\Property(property="predikat", type="array", @OA\Items(example={"Predikat field is required."}))
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

        $pesertapelatihanketerampilan = PesertaPelatihanKeterampilan::create($request->all());
        if ($pesertapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $pesertapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/pesertapelatihanketerampilan/{id}",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="Update PesertaPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PesertaPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_daftar_peserta_pelatihan_keterampilan", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/id_daftar_peserta_pelatihan_keterampilan"),
     *              @OA\Property(property="id_wbp", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/id_wbp"),
     *              @OA\Property(property="kehadiran", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/kehadiran"),
     *              @OA\Property(property="no_sertifikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/no_sertifikat"),
     *              @OA\Property(property="file_sertifikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/file_sertifikat"),
     *              @OA\Property(property="nilai", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/nilai"),
     *              @OA\Property(property="predikat", ref="#/components/schemas/PesertaPelatihanKeterampilan/properties/predikat"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_daftar_peserta_pelatihan_keterampilan", type="array", @OA\Items(example={"id_daftar_peserta_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="id_wbp", type="array", @OA\Items(example={"Id_wbp field is required."})),
     *              @OA\Property(property="kehadiran", type="array", @OA\Items(example={"Kehadiran field is required."})),
     *              @OA\Property(property="no_sertifikat", type="array", @OA\Items(example={"No_sertifikat field is required."})),
     *              @OA\Property(property="file_sertifikat", type="array", @OA\Items(example={"File_sertifikat field is required."})),
     *              @OA\Property(property="nilai", type="array", @OA\Items(example={"Nilai field is required."})),
     *              @OA\Property(property="predikat", type="array", @OA\Items(example={"Predikat field is required."}))
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

        $pesertapelatihanketerampilan = PesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($pesertapelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPelatihanKeterampilan berhasil diubah.",
                'data' => $pesertapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/pesertapelatihanketerampilan/{id}",
     *      tags={"PesertaPelatihanKeterampilan"},
     *      summary="PesertaPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="PesertaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="PesertaPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesertapelatihanketerampilan = PesertaPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($pesertapelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "PesertaPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "PesertaPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }
}
