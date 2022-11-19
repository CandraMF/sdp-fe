<?php

namespace App\Http\Controllers;

use App\Models\Upt;
use App\Services\UptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UptController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new UptService();
        $this->rules = array (
  'uraian' => 'nullable',
  'kanwil' => 'nullable',
  'jenis' => 'nullable',
  'kelas' => 'nullable',
  'kapasitas' => 'required',
  'alamat' => 'nullable',
  'telpon' => 'nullable',
  'fax' => 'nullable',
  'kepala_upt' => 'nullable',
  'jabatan_ku' => 'nullable',
  'pangkat_ku' => 'nullable',
  'nip_ku' => 'nullable',
  'pejabat_upt' => 'nullable',
  'jabatan_pu' => 'nullable',
  'pangkat_pu' => 'nullable',
  'nip_pu' => 'nullable',
  'histori_remisi_tertentu' => 'nullable',
  'dati2' => 'nullable',
  'regf_month' => 'required',
  'kapasitas_kunjungan' => 'nullable',
  'limit_kunjungan' => 'nullable',
  'tahun_remisi' => 'nullable',
  'limit_tahun_remisi' => 'nullable',
  'lap_reg_scheduler' => 'nullable',
  'tgl_pemberlakuan_permen' => 'nullable',
  'ip' => 'nullable',
  'login' => 'nullable',
  'password' => 'nullable',
  'sdp_ada' => 'required',
  'email' => 'nullable',
  'website' => 'nullable',
  'rupbasan_id' => 'nullable',
  'bapas_id' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/upt",
     *      tags={"Upt"},
     *      summary="List of Upt",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="kapasitas:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="uraian,kanwil,jenis,kelas,kapasitas,alamat,telpon,fax,kepala_upt,jabatan_ku,pangkat_ku,nip_ku,pejabat_upt,jabatan_pu,pangkat_pu,nip_pu,histori_remisi_tertentu,dati2,regf_month,kapasitas_kunjungan,limit_kunjungan,tahun_remisi,limit_tahun_remisi,lap_reg_scheduler,tgl_pemberlakuan_permen,ip,login,password,sdp_ada,email,website,rupbasan_id,bapas_id"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt data successfully loaded"),
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
        $upt = $this->service->search($data, $request->url());

        return response()->json($upt);
    }

    /**
     * @OA\Get(
     *      path="/upt/dropdown",
     *      tags={"Upt"},
     *      summary="List of Upt",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["kapasitas"];
        $columns[] = "id_upt";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Upt::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $upt = $data->get();

        return response()->json($upt);
    }

    /**
     * @OA\Get(
     *      path="/upt/schema",
     *      tags={"Upt"},
     *      summary="Schema of Upt",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt schema successfully loaded"),
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
        $fields = array (
  0 => 
  array (
    'Field' => 'id_upt',
    'Type' => 'BIGINT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => ' UNSIGNED AUTO_INCREMENT',
  ),
  1 => 
  array (
    'Field' => 'uraian',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'kanwil',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'jenis',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'kelas',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'kapasitas',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'alamat',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'telpon',
    'Type' => 'VARCHAR(20)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'fax',
    'Type' => 'VARCHAR(20)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'kepala_upt',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'jabatan_ku',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'pangkat_ku',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  12 => 
  array (
    'Field' => 'nip_ku',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  13 => 
  array (
    'Field' => 'pejabat_upt',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  14 => 
  array (
    'Field' => 'jabatan_pu',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  15 => 
  array (
    'Field' => 'pangkat_pu',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  16 => 
  array (
    'Field' => 'nip_pu',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  17 => 
  array (
    'Field' => 'histori_remisi_tertentu',
    'Type' => 'TEXT',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  18 => 
  array (
    'Field' => 'dati2',
    'Type' => 'VARCHAR(4)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  19 => 
  array (
    'Field' => 'regf_month',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  20 => 
  array (
    'Field' => 'kapasitas_kunjungan',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  21 => 
  array (
    'Field' => 'limit_kunjungan',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  22 => 
  array (
    'Field' => 'tahun_remisi',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  23 => 
  array (
    'Field' => 'limit_tahun_remisi',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  24 => 
  array (
    'Field' => 'lap_reg_scheduler',
    'Type' => 'TIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  25 => 
  array (
    'Field' => 'tgl_pemberlakuan_permen',
    'Type' => 'DATETIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  26 => 
  array (
    'Field' => 'ip',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  27 => 
  array (
    'Field' => 'login',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  28 => 
  array (
    'Field' => 'password',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  29 => 
  array (
    'Field' => 'sdp_ada',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  30 => 
  array (
    'Field' => 'email',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  31 => 
  array (
    'Field' => 'website',
    'Type' => 'VARCHAR(100)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  32 => 
  array (
    'Field' => 'rupbasan_id',
    'Type' => 'BIGINT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  33 => 
  array (
    'Field' => 'bapas_id',
    'Type' => 'BIGINT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'upt', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_upt', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/upt'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/upt/{id}",
     *      tags={"Upt"},
     *      summary="Upt details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Upt ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $upt = Upt::where('id_upt', $id)->firstOrFail();
        if (!$upt->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Upt tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($upt);
        //$collection = collect($upt);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Upt ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/upt",
     *      tags={"Create Upt"},
     *      summary="Create Upt",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="kapasitas", ref="#/components/schemas/Upt/properties/kapasitas"),
*              @OA\Property(property="regf_month", ref="#/components/schemas/Upt/properties/regf_month"),
*              @OA\Property(property="sdp_ada", ref="#/components/schemas/Upt/properties/sdp_ada"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="kapasitas", type="array", @OA\Items(example={"Kapasitas field is required."})),
*              @OA\Property(property="regf_month", type="array", @OA\Items(example={"Regf_month field is required."})),
*              @OA\Property(property="sdp_ada", type="array", @OA\Items(example={"Sdp_ada field is required."}))
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

        $upt = Upt::create($request->all());
        if ($upt->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Upt berhasil ditambahkan.",
                'data' => $upt
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Upt tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/upt/{id}",
     *      tags={"Upt"},
     *      summary="Update Upt",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Upt ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="kapasitas", ref="#/components/schemas/Upt/properties/kapasitas"),
*              @OA\Property(property="regf_month", ref="#/components/schemas/Upt/properties/regf_month"),
*              @OA\Property(property="sdp_ada", ref="#/components/schemas/Upt/properties/sdp_ada"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="kapasitas", type="array", @OA\Items(example={"Kapasitas field is required."})),
*              @OA\Property(property="regf_month", type="array", @OA\Items(example={"Regf_month field is required."})),
*              @OA\Property(property="sdp_ada", type="array", @OA\Items(example={"Sdp_ada field is required."}))
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

        $upt = Upt::where('id_upt', $id)->firstOrFail();
        if ($upt->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Upt berhasil diubah.",
                'data' => $upt
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Upt tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/upt/{id}",
     *      tags={"Upt"},
     *      summary="Upt Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Upt ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Upt deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upt = Upt::where('id_upt', $id)->firstOrFail();

        if ($upt->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Upt berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Upt tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
