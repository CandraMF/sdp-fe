<?php

namespace App\Http\Controllers;

use App\Models\DaftarReferensi;
use App\Services\DaftarReferensiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarReferensiController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new DaftarReferensiService();
        $this->rules = array(
            'groups' => 'nullable',
            'deskripsi' => 'nullable',
            'catatan' => 'nullable',
            'content' => 'nullable',
        );
    }

    /**
     * @OA\Get(
     *      path="/daftarreferensi",
     *      tags={"DaftarReferensi"},
     *      summary="List of DaftarReferensi",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_lookup:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="groups,deskripsi,catatan,content"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarReferensi data successfully loaded"),
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
        $daftarreferensi = $this->service->search($data, $request->url());

        return response()->json($daftarreferensi);
    }

    /**
     * @OA\Get(
     *      path="/daftarreferensi/dropdown",
     *      tags={"DaftarReferensi"},
     *      summary="List of DaftarReferensi",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarReferensi data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_lookup"];
        $columns[] = "id_lookup";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = DaftarReferensi::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $daftarreferensi = $data->get();

        return response()->json($daftarreferensi);
    }

    /**
     * @OA\Get(
     *      path="/daftarreferensi/schema",
     *      tags={"DaftarReferensi"},
     *      summary="Schema of DaftarReferensi",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarReferensi schema successfully loaded"),
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
                'Field' => 'id_lookup',
                'Type' => 'VARCHAR(35)',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => '',
            ),
            1 =>
            array(
                'Field' => 'groups',
                'Type' => 'VARCHAR(100)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'deskripsi',
                'Type' => 'VARCHAR(255)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'catatan',
                'Type' => 'VARCHAR(255)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'content',
                'Type' => 'TEXT',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'status_download',
                'Type' => 'TINYINT(1)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => '0',
                'Extra' => '',
            ),
        );
        $schema = array(
            'name' => 'daftarreferensi',
            'module' => 'lain-lain',
            'primary_key' => 'id_lookup',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/daftarreferensi'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/daftarreferensi/{id}",
     *      tags={"DaftarReferensi"},
     *      summary="DaftarReferensi details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="DaftarReferensi ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarReferensi successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftarreferensi = DaftarReferensi::where('id_lookup', $id)->firstOrFail();
        if (!$daftarreferensi->exists) {
            return response()->json([
                'status' => 500,
                'message' => "DaftarReferensi tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($daftarreferensi);
        //$collection = collect($daftarreferensi);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "DaftarReferensi ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/daftarreferensi",
     *      tags={"Create DaftarReferensi"},
     *      summary="Create DaftarReferensi",
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
     *              @OA\Property(property="message", type="string", example="DaftarReferensi successfully created"),
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



        $txtgroups = explode(" ", $request->groups);
        $firtword = "";
        foreach ($txtgroups as $w) {
            $firtword .= mb_substr($w, 0, 1);
        }


        $last = DaftarReferensi::whereGroups($request->groups)->orderBy('id_lookup', 'desc')->first();
        $str_id_lookup = !empty($last->id_lookup) ? $last->id_lookup : 0;

        $digit = floatval(substr(floatval($str_id_lookup), 0, 2)) + 1;

        $nol = "00";
        $number = substr($nol, 0, "-" . strlen(trim($digit))) . $digit;

        $prm_id_lookup = $firtword . $number . rand(10, 99);
        $request->merge(['id_lookup' => $prm_id_lookup]);

        $daftarreferensi = DaftarReferensi::create($request->all());
        if ($daftarreferensi->exists) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarReferensi berhasil ditambahkan.",
                'data' => $daftarreferensi
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarReferensi tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/daftarreferensi/{id}",
     *      tags={"DaftarReferensi"},
     *      summary="Update DaftarReferensi",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarReferensi ID"),
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
     *              @OA\Property(property="message", type="string", example="DaftarReferensi successfully updated"),
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


        $daftarreferensi = DaftarReferensi::where('id_lookup', $id)->firstOrFail();
        if ($daftarreferensi->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarReferensi berhasil diubah.",
                'data' => $daftarreferensi
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarReferensi tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/daftarreferensi/{id}",
     *      tags={"DaftarReferensi"},
     *      summary="DaftarReferensi Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="DaftarReferensi ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="DaftarReferensi deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daftarreferensi = DaftarReferensi::where('id_lookup', $id)->firstOrFail();

        if ($daftarreferensi->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "DaftarReferensi berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "DaftarReferensi tidak dapat dihapus.",
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
