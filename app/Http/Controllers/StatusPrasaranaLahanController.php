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
            'id_prasarana_lahan' => 'nullable',
            'tahun' => 'nullable',
            'bulan' => 'nullable',
            'status' => 'nullable',
            'kepemilkan' => 'nullable',
            'luas_dipakai' => 'nullable',
            'lahan_tidur' => 'nullable',
            'satuan' => 'nullable',
            'foto' => 'nullable',
            'keterangan' => 'nullable',
            'update_terakhir' => 'nullable',
            'update_oleh' => 'nullable',
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
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_status_prasarana_lahan:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_prasarana_lahan,tahun,bulan,status,kepemilkan,luas_dipakai,lahan_tidur,satuan,foto,keterangan,update_terakhir,update_oleh"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_status_prasarana_lahan"];
        $columns[] = "id_status_prasarana_lahan";
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
                'Field' => 'id_status_prasarana_lahan',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => '',
            ),
            1 =>
            array(
                'Field' => 'id_prasarana_lahan',
                'Type' => 'INT()',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'tahun',
                'Type' => 'INT()',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'bulan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'status',
                'Type' => 'VARCHAR(50)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'kepemilkan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'luas_dipakai',
                'Type' => 'DECIMAL(, 6)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'lahan_tidur',
                'Type' => 'DECIMAL(, 6)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'satuan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            9 =>
            array(
                'Field' => 'foto',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            10 =>
            array(
                'Field' => 'keterangan',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            11 =>
            array(
                'Field' => 'update_terakhir',
                'Type' => 'TIMESTAMP',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            12 =>
            array(
                'Field' => 'update_oleh',
                'Type' => 'VARCHAR(32)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
        );
        $schema = array(
            'name' => 'statusprasaranalahan',
            'module' => 'lain-lain',
            'primary_key' => 'id_status_prasarana_lahan',
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
        $statusprasaranalahan = StatusPrasaranaLahan::where('id_status_prasarana_lahan', $id)->firstOrFail();
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
     
     *          ),
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['update_terakhir' => date('Y-m-d H:i:s')]);
$this->validate($request, $this->rules);


        //   $request->foto->store('status_prasarana_lahan', 'public');


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $allowedfileExtention = ['png', 'jpg', 'jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtention);

            if ($check) {
                $name = time() . $file->getClientOriginalExtension();
                $file->move('images', $name);
                $request->merge(['foto' => $name]);
            }
        }


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
        $request->merge(['update_terakhir' => date('Y-m-d H:i:s')]);
$this->validate($request, $this->rules);


        $statusprasaranalahan = StatusPrasaranaLahan::where('id_status_prasarana_lahan', $id)->firstOrFail();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $allowedfileExtention = ['png', 'jpg', 'jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtention);

            if ($check) {
                $name = time() . $file->getClientOriginalExtension();
                $file->move('images', $name);
                $request->merge(['foto' => $name]);
            }
        }

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
        $statusprasaranalahan = StatusPrasaranaLahan::where('id_status_prasarana_lahan', $id)->firstOrFail();

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
