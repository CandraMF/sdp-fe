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
            'id_mitra' => 'required',
            'jenis_mitra' => 'required',
            'kontrak_dengan' => 'required',
            'id_kanwil' => 'nullable',
            'id_upt' => 'nullable',
            'nomor_kontrak' => 'required',
            'kontrak_awal' => 'required',
            'kontrak_akhir' => 'required',
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
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_mitra:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_mitra,jenis_mitra,kontrak_dengan,id_kanwil,id_upt,nomor_kontrak,kontrak_awal,kontrak_akhir"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_mitra"];
        $columns[] = "id";
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
                'Field' => 'id',
                'Type' => 'BIGINT()',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => ' UNSIGNED AUTO_INCREMENT',
            ),
            1 =>
            array(
                'Field' => 'id_mitra',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'jenis_mitra',
                'Type' => 'VARCHAR(32)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'kontrak_dengan',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
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
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            7 =>
            array(
                'Field' => 'kontrak_awal',
                'Type' => 'DATETIME',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            8 =>
            array(
                'Field' => 'kontrak_akhir',
                'Type' => 'DATETIME',
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
            'name' => 'mitrakontrak',
            'module' => 'lain-lain',
            'primary_key' => 'id',
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
        $mitrakontrak = MitraKontrak::where('id', $id)->firstOrFail();
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
     *              @OA\Property(property="id_mitra", ref="#/components/schemas/MitraKontrak/properties/id_mitra"),
     *              @OA\Property(property="jenis_mitra", ref="#/components/schemas/MitraKontrak/properties/jenis_mitra"),
     *              @OA\Property(property="kontrak_dengan", ref="#/components/schemas/MitraKontrak/properties/kontrak_dengan"),
     *              @OA\Property(property="nomor_kontrak", ref="#/components/schemas/MitraKontrak/properties/nomor_kontrak"),
     *              @OA\Property(property="kontrak_awal", ref="#/components/schemas/MitraKontrak/properties/kontrak_awal"),
     *              @OA\Property(property="kontrak_akhir", ref="#/components/schemas/MitraKontrak/properties/kontrak_akhir"),
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
     *              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
     *              @OA\Property(property="jenis_mitra", type="array", @OA\Items(example={"Jenis_mitra field is required."})),
     *              @OA\Property(property="kontrak_dengan", type="array", @OA\Items(example={"Kontrak_dengan field is required."})),
     *              @OA\Property(property="nomor_kontrak", type="array", @OA\Items(example={"Nomor_kontrak field is required."})),
     *              @OA\Property(property="kontrak_awal", type="array", @OA\Items(example={"Kontrak_awal field is required."})),
     *              @OA\Property(property="kontrak_akhir", type="array", @OA\Items(example={"Kontrak_akhir field is required."}))
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
     *              @OA\Property(property="id_mitra", ref="#/components/schemas/MitraKontrak/properties/id_mitra"),
     *              @OA\Property(property="jenis_mitra", ref="#/components/schemas/MitraKontrak/properties/jenis_mitra"),
     *              @OA\Property(property="kontrak_dengan", ref="#/components/schemas/MitraKontrak/properties/kontrak_dengan"),
     *              @OA\Property(property="nomor_kontrak", ref="#/components/schemas/MitraKontrak/properties/nomor_kontrak"),
     *              @OA\Property(property="kontrak_awal", ref="#/components/schemas/MitraKontrak/properties/kontrak_awal"),
     *              @OA\Property(property="kontrak_akhir", ref="#/components/schemas/MitraKontrak/properties/kontrak_akhir"),
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
     *              @OA\Property(property="id_mitra", type="array", @OA\Items(example={"Id_mitra field is required."})),
     *              @OA\Property(property="jenis_mitra", type="array", @OA\Items(example={"Jenis_mitra field is required."})),
     *              @OA\Property(property="kontrak_dengan", type="array", @OA\Items(example={"Kontrak_dengan field is required."})),
     *              @OA\Property(property="nomor_kontrak", type="array", @OA\Items(example={"Nomor_kontrak field is required."})),
     *              @OA\Property(property="kontrak_awal", type="array", @OA\Items(example={"Kontrak_awal field is required."})),
     *              @OA\Property(property="kontrak_akhir", type="array", @OA\Items(example={"Kontrak_akhir field is required."}))
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

        $mitrakontrak = MitraKontrak::where('id', $id)->firstOrFail();
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
        $mitrakontrak = MitraKontrak::where('id', $id)->firstOrFail();

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
