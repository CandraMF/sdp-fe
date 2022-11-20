<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Services\PegawaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new PegawaiService();
        $this->rules = array (
  'nip' => 'nullable',
  'nama' => 'nullable',
  'id_tempat_lahir' => 'nullable',
  'tempat_lahir_lain' => 'nullable',
  'tgl_lahir' => 'nullable',
  'id_jenis_kelamin' => 'nullable',
  'alamat' => 'nullable',
  'jabatan' => 'nullable',
  'pangkat' => 'nullable',
  'golongan' => 'nullable',
  'bagian' => 'nullable',
  'email' => 'nullable',
  'telepon' => 'nullable',
  'foto' => 'nullable',
  'id_upt' => 'nullable',
  'konsolidasi' => 'nullable',
  'is_active' => 'required',
  'is_pk' => 'required',
  'id_pengunjung_finger' => 'nullable',
  'created' => 'nullable',
  'created_by' => 'nullable',
);
    }

    /**
     * @OA\Get(
     *      path="/pegawai",
     *      tags={"Pegawai"},
     *      summary="List of Pegawai",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="is_active:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="nip,nama,id_tempat_lahir,tempat_lahir_lain,tgl_lahir,id_jenis_kelamin,alamat,jabatan,pangkat,golongan,bagian,email,telepon,foto,id_upt,konsolidasi,is_active,is_pk,id_pengunjung_finger,created,created_by"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai data successfully loaded"),
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
        $pegawai = $this->service->search($data, $request->url());

        return response()->json($pegawai);
    }

    /**
     * @OA\Get(
     *      path="/pegawai/dropdown",
     *      tags={"Pegawai"},
     *      summary="List of Pegawai",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["is_active"];
        $columns[] = "id_pegawai";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Pegawai::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $pegawai = $data->get();

        return response()->json($pegawai);
    }

    /**
     * @OA\Get(
     *      path="/pegawai/schema",
     *      tags={"Pegawai"},
     *      summary="Schema of Pegawai",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai schema successfully loaded"),
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
    'Field' => 'id_pegawai',
    'Type' => 'VARCHAR(35)',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => '',
  ),
  1 => 
  array (
    'Field' => 'nip',
    'Type' => 'VARCHAR(50)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 => 
  array (
    'Field' => 'nama',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 => 
  array (
    'Field' => 'id_tempat_lahir',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 => 
  array (
    'Field' => 'tempat_lahir_lain',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  5 => 
  array (
    'Field' => 'tgl_lahir',
    'Type' => 'DATETIME',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  6 => 
  array (
    'Field' => 'id_jenis_kelamin',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  7 => 
  array (
    'Field' => 'alamat',
    'Type' => 'TEXT',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  8 => 
  array (
    'Field' => 'jabatan',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  9 => 
  array (
    'Field' => 'pangkat',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  10 => 
  array (
    'Field' => 'golongan',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  11 => 
  array (
    'Field' => 'bagian',
    'Type' => 'VARCHAR(155)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  12 => 
  array (
    'Field' => 'email',
    'Type' => 'VARCHAR(150)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  13 => 
  array (
    'Field' => 'telepon',
    'Type' => 'VARCHAR(20)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  14 => 
  array (
    'Field' => 'foto',
    'Type' => 'VARCHAR(255)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  15 => 
  array (
    'Field' => 'id_upt',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  16 => 
  array (
    'Field' => 'konsolidasi',
    'Type' => 'INT()',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  17 => 
  array (
    'Field' => 'is_active',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '1',
    'Extra' => '',
  ),
  18 => 
  array (
    'Field' => 'is_pk',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  19 => 
  array (
    'Field' => 'id_pengunjung_finger',
    'Type' => 'VARCHAR(35)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  20 => 
  array (
    'Field' => 'is_deleted',
    'Type' => 'TINYINT(1)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => '0',
    'Extra' => '',
  ),
  21 => 
  array (
    'Field' => 'created',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  22 => 
  array (
    'Field' => 'created_by',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  23 => 
  array (
    'Field' => 'updated',
    'Type' => 'TIMESTAMP',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  24 => 
  array (
    'Field' => 'updated_by',
    'Type' => 'VARCHAR(32)',
    'Null' => 'YES',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'pegawai', 
            'module' => 'lain-lain', 
            'primary_key' => 'id_pegawai', 
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/pegawai'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/pegawai/{id}",
     *      tags={"Pegawai"},
     *      summary="Pegawai details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Pegawai ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();
        if (!$pegawai->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Pegawai tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($pegawai);
        //$collection = collect($pegawai);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Pegawai ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/pegawai",
     *      tags={"Create Pegawai"},
     *      summary="Create Pegawai",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="is_active", ref="#/components/schemas/Pegawai/properties/is_active"),
*              @OA\Property(property="is_pk", ref="#/components/schemas/Pegawai/properties/is_pk"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="is_active", type="array", @OA\Items(example={"Is_active field is required."})),
*              @OA\Property(property="is_pk", type="array", @OA\Items(example={"Is_pk field is required."}))
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


        $pegawai = Pegawai::create($request->all());
        if ($pegawai->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Pegawai berhasil ditambahkan.",
                'data' => $pegawai
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Pegawai tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/pegawai/{id}",
     *      tags={"Pegawai"},
     *      summary="Update Pegawai",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Pegawai ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="is_active", ref="#/components/schemas/Pegawai/properties/is_active"),
*              @OA\Property(property="is_pk", ref="#/components/schemas/Pegawai/properties/is_pk"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="is_active", type="array", @OA\Items(example={"Is_active field is required."})),
*              @OA\Property(property="is_pk", type="array", @OA\Items(example={"Is_pk field is required."}))
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


        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();
        if ($pegawai->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Pegawai berhasil diubah.",
                'data' => $pegawai
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Pegawai tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/pegawai/{id}",
     *      tags={"Pegawai"},
     *      summary="Pegawai Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Pegawai ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Pegawai deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        if ($pegawai->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Pegawai berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Pegawai tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
