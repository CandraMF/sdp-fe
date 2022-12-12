<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelatihanKeterampilan;
use App\Services\JadwalPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new JadwalPelatihanKeterampilanService();
        $this->rules = array(
            'id_pelatihan_keterampilan' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_instruktur' => 'required',
            'materi_pelatihan_keterampilan' => 'required',
            'foto' => 'nullable',
            'status' => 'required',
        );
    }

    /**
     * @OA\Get(
     *      path="/jadwalpelatihanketerampilan",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="List of JadwalPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_pelatihan_keterampilan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_pelatihan_keterampilan,tanggal,jam_mulai,jam_selesai,id_instruktur,materi_pelatihan_keterampilan,foto,status"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan data successfully loaded"),
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
        $jadwalpelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($jadwalpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpelatihanketerampilan/dropdown",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="List of JadwalPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_pelatihan_keterampilan"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = JadwalPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $jadwalpelatihanketerampilan = $data->get();

        return response()->json($jadwalpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpelatihanketerampilan/schema",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="Schema of JadwalPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan schema successfully loaded"),
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
                'Field' => 'id_pelatihan_keterampilan',
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
                'Field' => 'jam_mulai',
                'Type' => 'TIME',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'jam_selesai',
                'Type' => 'TIME',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'id_instruktur',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'materi_pelatihan_keterampilan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'foto',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'status',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            9 =>
            array(
                'Field' => 'updated_at',
                'Type' => 'TIMESTAMP',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            10 =>
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
            'name' => 'jadwalpelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/jadwalpelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/jadwalpelatihanketerampilan/{id}",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="JadwalPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="JadwalPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalpelatihanketerampilan = JadwalPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$jadwalpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($jadwalpelatihanketerampilan);
        //$collection = collect($jadwalpelatihanketerampilan);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "JadwalPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/jadwalpelatihanketerampilan",
     *      tags={"Create JadwalPelatihanKeterampilan"},
     *      summary="Create JadwalPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/tanggal"),
     *              @OA\Property(property="jam_mulai", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/jam_mulai"),
     *              @OA\Property(property="jam_selesai", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/jam_selesai"),
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/id_instruktur"),
     *              @OA\Property(property="materi_pelatihan_keterampilan", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/materi_pelatihan_keterampilan"),
     *              @OA\Property(property="status", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/status"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="jam_mulai", type="array", @OA\Items(example={"Jam_mulai field is required."})),
     *              @OA\Property(property="jam_selesai", type="array", @OA\Items(example={"Jam_selesai field is required."})),
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
     *              @OA\Property(property="materi_pelatihan_keterampilan", type="array", @OA\Items(example={"Materi_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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

        $jadwalpelatihanketerampilan = JadwalPelatihanKeterampilan::create($request->all());
        if ($jadwalpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $jadwalpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/jadwalpelatihanketerampilan/{id}",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="Update JadwalPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="JadwalPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *              @OA\Property(property="tanggal", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/tanggal"),
     *              @OA\Property(property="jam_mulai", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/jam_mulai"),
     *              @OA\Property(property="jam_selesai", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/jam_selesai"),
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/id_instruktur"),
     *              @OA\Property(property="materi_pelatihan_keterampilan", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/materi_pelatihan_keterampilan"),
     *              @OA\Property(property="status", ref="#/components/schemas/JadwalPelatihanKeterampilan/properties/status"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="tanggal", type="array", @OA\Items(example={"Tanggal field is required."})),
     *              @OA\Property(property="jam_mulai", type="array", @OA\Items(example={"Jam_mulai field is required."})),
     *              @OA\Property(property="jam_selesai", type="array", @OA\Items(example={"Jam_selesai field is required."})),
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
     *              @OA\Property(property="materi_pelatihan_keterampilan", type="array", @OA\Items(example={"Materi_pelatihan_keterampilan field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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

        $jadwalpelatihanketerampilan = JadwalPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($jadwalpelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPelatihanKeterampilan berhasil diubah.",
                'data' => $jadwalpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/jadwalpelatihanketerampilan/{id}",
     *      tags={"JadwalPelatihanKeterampilan"},
     *      summary="JadwalPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="JadwalPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="JadwalPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalpelatihanketerampilan = JadwalPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($jadwalpelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "JadwalPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "JadwalPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }
}
