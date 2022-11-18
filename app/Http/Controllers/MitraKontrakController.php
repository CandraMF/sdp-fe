<?php

namespace App\Http\Controllers;

use App\Models\MitraKontrak;
use App\Services\MitraKontrakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraKontrakController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new MitraKontrakService();
        $this->rules = array(
            'id_mitra' => 'nullable',
            'jenis_mitra' => 'nullable',
            'kontrak_dengan' => 'nullable',
            'id_kanwil' => 'nullable',
            'id_upt' => 'nullable',
            'nomor_kontrak' => 'nullable',
            'kontrak_awal' => 'nullable',
            'kontrak_akhir' => 'nullable',
            'update_terakhir' => 'nullable',
            'update_oleh' => 'nullable',
        );
    }

    /**
     * @OA\Get(
     *      path="/mitrakontrak",
     *      tags={"MitraKontrak"},
     *      summary="List of MitraKontrak",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_kontrak:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_mitra,jenis_mitra,kontrak_dengan,id_kanwil,id_upt,nomor_kontrak,kontrak_awal,kontrak_akhir,update_terakhir,update_oleh"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="MitraKontrak data successfully loaded"),
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
        $mitrakontrak = $this->service->search($data, $request->url());

        return response()->json($mitrakontrak);
    }

    /**
     * @OA\Get(
     *      path="/mitrakontrak/dropdown",
     *      tags={"MitraKontrak"},
     *      summary="List of MitraKontrak",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="MitraKontrak data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_kontrak"];
        $columns[] = "id_kontrak";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = MitraKontrak::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $mitrakontrak = $data->get();

        return response()->json($mitrakontrak);
    }

    /**
     * @OA\Get(
     *      path="/mitrakontrak/schema",
     *      tags={"MitraKontrak"},
     *      summary="Schema of MitraKontrak",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="MitraKontrak schema successfully loaded"),
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
                'Field' => 'id_kontrak',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => '',
            ),
            1 =>
            array(
                'Field' => 'id_mitra',
                'Type' => 'VARCHAR(32)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'jenis_mitra',
                'Type' => 'VARCHAR(32)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'kontrak_dengan',
                'Type' => 'VARCHAR(100)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'id_kanwil',
                'Type' => 'INT()',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'id_upt',
                'Type' => 'INT()',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            6 =>
            array(
                'Field' => 'nomor_kontrak',
                'Type' => 'VARCHAR(200)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'kontrak_awal',
                'Type' => 'DATETIME',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'kontrak_akhir',
                'Type' => 'DATETIME',
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
            'name' => 'mitrakontrak',
            'module' => 'lain-lain',
            'primary_key' => 'id_kontrak',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/mitrakontrak'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/mitrakontrak/{id}",
     *      tags={"MitraKontrak"},
     *      summary="MitraKontrak details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="MitraKontrak ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="MitraKontrak successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mitrakontrak = MitraKontrak::where('id_kontrak', $id)->firstOrFail();
        if (!$mitrakontrak->exists) {
            return response()->json([
                'status' => 500,
                'message' => "MitraKontrak tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($mitrakontrak);
        //$collection = collect($mitrakontrak);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "MitraKontrak ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/mitrakontrak",
     *      tags={"Create MitraKontrak"},
     *      summary="Create MitraKontrak",
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
     *              @OA\Property(property="message", type="string", example="MitraKontrak successfully created"),
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

        $mitrakontrak = MitraKontrak::create($request->all());
        if ($mitrakontrak->exists) {
            return response()->json([
                'status' => 200,
                'message' => "MitraKontrak berhasil ditambahkan.",
                'data' => $mitrakontrak
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "MitraKontrak tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/mitrakontrak/{id}",
     *      tags={"MitraKontrak"},
     *      summary="Update MitraKontrak",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="MitraKontrak ID"),
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
     *              @OA\Property(property="message", type="string", example="MitraKontrak successfully updated"),
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

        $mitrakontrak = MitraKontrak::where('id_kontrak', $id)->firstOrFail();
        if ($mitrakontrak->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "MitraKontrak berhasil diubah.",
                'data' => $mitrakontrak
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "MitraKontrak tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/mitrakontrak/{id}",
     *      tags={"MitraKontrak"},
     *      summary="MitraKontrak Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="MitraKontrak ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="MitraKontrak deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mitrakontrak = MitraKontrak::where('id_kontrak', $id)->firstOrFail();

        if ($mitrakontrak->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "MitraKontrak berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "MitraKontrak tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }
}
