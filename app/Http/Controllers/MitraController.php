<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Services\MitraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new MitraService();
        $this->rules = array(
            'nama_mitra' => 'required',
            'nama_pic' => 'required',
            'alamat' => 'required',
            'id_dati2' => 'required',
            'no_telp' => 'nullable',
            'no_hp' => 'required',
            'email' => 'required',
            'keterangan' => 'nullable',
        );
    }

    /**
     * @OA\Get(
     *      path="/mitra",
     *      tags={"Mitra"},
     *      summary="List of Mitra",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="nama_mitra:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="nama_mitra,nama_pic,alamat,id_dati2,no_telp,no_hp,email,keterangan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra data successfully loaded"),
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
        $mitra = $this->service->search($data, $request->url());

        return response()->json($mitra);
    }

    /**
     * @OA\Get(
     *      path="/mitra/dropdown",
     *      tags={"Mitra"},
     *      summary="List of Mitra",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["nama_mitra"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Mitra::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $mitra = $data->get();

        return response()->json($mitra);
    }

    /**
     * @OA\Get(
     *      path="/mitra/schema",
     *      tags={"Mitra"},
     *      summary="Schema of Mitra",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra schema successfully loaded"),
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
                'Field' => 'nama_mitra',
                'Type' => 'VARCHAR(100)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'nama_pic',
                'Type' => 'VARCHAR(100)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'alamat',
                'Type' => 'VARCHAR(200)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'id_dati2',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'no_telp',
                'Type' => 'VARCHAR(20)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'no_hp',
                'Type' => 'VARCHAR(20)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'email',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
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
            'name' => 'mitra',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/mitra'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/mitra/{id}",
     *      tags={"Mitra"},
     *      summary="Mitra details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Mitra ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $defaultColumn = ['mitra.updated_by', 'mitra.updated_at', 'mitra.id', 'mitra.nama_mitra', 'mitra.nama_pic', 'mitra.alamat', 'mitra.no_telp', 'provinsi.deskripsi as provinsi', 'dati2.deskripsi as kabkota', 'mitra.id_dati2', 'mitra.no_hp', 'mitra.email', 'mitra.keterangan', 'provinsi.id_provinsi'];
        $mitra = Mitra::query();
        $mitra = $mitra->select($defaultColumn);
        $mitra = $mitra->join('dati2', 'mitra.id_dati2', '=', 'dati2.id_dati2');
        $mitra = $mitra->join('provinsi', 'dati2.id_provinsi', '=', 'provinsi.id_provinsi');
        $mitra = $mitra->where('mitra.id', $id)->firstOrFail();

        if (!$mitra->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Mitra tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($mitra);
        //$collection = collect($mitra);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "Mitra ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/mitra",
     *      tags={"Create Mitra"},
     *      summary="Create Mitra",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="nama_mitra", ref="#/components/schemas/Mitra/properties/nama_mitra"),
     *              @OA\Property(property="nama_pic", ref="#/components/schemas/Mitra/properties/nama_pic"),
     *              @OA\Property(property="alamat", ref="#/components/schemas/Mitra/properties/alamat"),
     *              @OA\Property(property="id_dati2", ref="#/components/schemas/Mitra/properties/id_dati2"),
     *              @OA\Property(property="no_hp", ref="#/components/schemas/Mitra/properties/no_hp"),
     *              @OA\Property(property="email", ref="#/components/schemas/Mitra/properties/email"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="nama_mitra", type="array", @OA\Items(example={"Nama_mitra field is required."})),
     *              @OA\Property(property="nama_pic", type="array", @OA\Items(example={"Nama_pic field is required."})),
     *              @OA\Property(property="alamat", type="array", @OA\Items(example={"Alamat field is required."})),
     *              @OA\Property(property="id_dati2", type="array", @OA\Items(example={"Id_dati2 field is required."})),
     *              @OA\Property(property="no_hp", type="array", @OA\Items(example={"No_hp field is required."})),
     *              @OA\Property(property="email", type="array", @OA\Items(example={"Email field is required."}))
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
        // $user = Auth::user();
        $request->merge(['updated_by' => 'admin']);
        $this->validate($request, $this->rules);

        $mitra = Mitra::create($request->all());
        if ($mitra->exists) {
            $id_mitra = Mitra::latest('updated_at')->first()->id;
            $data_mitra = ['id' =>  $id_mitra];
            return response()->json([
                'status' => 200,
                'message' => "Mitra berhasil ditambahkan.",
                'data' => $data_mitra
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Mitra tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/mitra/{id}",
     *      tags={"Mitra"},
     *      summary="Update Mitra",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Mitra ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="nama_mitra", ref="#/components/schemas/Mitra/properties/nama_mitra"),
     *              @OA\Property(property="nama_pic", ref="#/components/schemas/Mitra/properties/nama_pic"),
     *              @OA\Property(property="alamat", ref="#/components/schemas/Mitra/properties/alamat"),
     *              @OA\Property(property="id_dati2", ref="#/components/schemas/Mitra/properties/id_dati2"),
     *              @OA\Property(property="no_hp", ref="#/components/schemas/Mitra/properties/no_hp"),
     *              @OA\Property(property="email", ref="#/components/schemas/Mitra/properties/email"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="nama_mitra", type="array", @OA\Items(example={"Nama_mitra field is required."})),
     *              @OA\Property(property="nama_pic", type="array", @OA\Items(example={"Nama_pic field is required."})),
     *              @OA\Property(property="alamat", type="array", @OA\Items(example={"Alamat field is required."})),
     *              @OA\Property(property="id_dati2", type="array", @OA\Items(example={"Id_dati2 field is required."})),
     *              @OA\Property(property="no_hp", type="array", @OA\Items(example={"No_hp field is required."})),
     *              @OA\Property(property="email", type="array", @OA\Items(example={"Email field is required."}))
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
        // $user = Auth::user();
        $request->merge(['updated_by' => 'admin']);
        $this->validate($request, $this->rules);

        $mitra = Mitra::where('id', $id)->firstOrFail();
        if ($mitra->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Mitra berhasil diubah.",
                'data' => $mitra
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Mitra tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/mitra/{id}",
     *      tags={"Mitra"},
     *      summary="Mitra Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Mitra ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Mitra deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mitra = Mitra::where('id', $id)->firstOrFail();

        if ($mitra->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Mitra berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Mitra tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }
}
