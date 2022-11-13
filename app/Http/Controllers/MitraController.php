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
            'nama_mitra' => 'nullable',
            'nama_pic' => 'nullable',
            'alamat' => 'nullable',
            'id_dati2' => 'nullable',
            'no_telp' => 'nullable',
            'no_hp' => 'nullable',
            'email' => 'nullable',
            'keterangan' => 'nullable',
            'update_terakhir' => 'nullable',
            'update_oleh' => 'nullable',
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
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_mitra:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="nama_mitra,nama_pic,alamat,id_dati2,no_telp,no_hp,email,keterangan,update_terakhir,update_oleh"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_mitra"];
        $columns[] = "id_mitra";
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
                'Field' => 'id_mitra',
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
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'nama_pic',
                'Type' => 'VARCHAR(100)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'alamat',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'id_dati2',
                'Type' => 'VARCHAR(32)',
                'Null' => 'YES',
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
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'email',
                'Type' => 'VARCHAR(50)',
                'Null' => 'YES',
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
                'Field' => 'update_terakhir',
                'Type' => 'TIMESTAMP',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            10 =>
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
            'name' => 'mitra',
            'module' => 'lain-lain',
            'primary_key' => 'id_mitra',
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
        $mitra = Mitra::where('id_mitra', $id)->firstOrFail();
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

        $mitra = Mitra::create($request->all());
        if ($mitra->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Mitra berhasil ditambahkan.",
                'data' => $mitra
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

        $mitra = Mitra::where('id_mitra', $id)->firstOrFail();
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
        $mitra = Mitra::where('id_mitra', $id)->firstOrFail();

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
