<?php

namespace App\Http\Controllers;

use App\Models\SaranaPelatihanKeterampilan;
use App\Services\SaranaPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranaPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new SaranaPelatihanKeterampilanService();
        $this->rules = array (
  'id_sarana' => 'required',
  'id_pelatihan_keterampilan' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/saranapelatihanketerampilan",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="List of SaranaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_sarana:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_sarana,id_pelatihan_keterampilan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan data successfully loaded"),
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
        $saranapelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($saranapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/saranapelatihanketerampilan/dropdown",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="List of SaranaPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_sarana"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = SaranaPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $saranapelatihanketerampilan = $data->get();

        return response()->json($saranapelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/saranapelatihanketerampilan/schema",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="Schema of SaranaPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan schema successfully loaded"),
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
    'Field' => 'id',
    'Type' => 'BIGINT()',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => ' AUTO_INCREMENT',
  ),
  1 =>
  array (
    'Field' => 'id_sarana',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  2 =>
  array (
    'Field' => 'id_pelatihan_keterampilan',
    'Type' => 'INT()',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  3 =>
  array (
    'Field' => 'updated_at',
    'Type' => 'TIMESTAMP',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
  4 =>
  array (
    'Field' => 'updated_by',
    'Type' => 'VARCHAR(32)',
    'Null' => 'NO',
    'Key' => NULL,
    'Default' => NULL,
    'Extra' => '',
  ),
);
        $schema = array(
            'name' => 'saranapelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/saranapelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/saranapelatihanketerampilan/{id}",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="SaranaPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="SaranaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saranapelatihanketerampilan = SaranaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$saranapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($saranapelatihanketerampilan);
        //$collection = collect($saranapelatihanketerampilan);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "SaranaPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/saranapelatihanketerampilan",
     *      tags={"Create SaranaPelatihanKeterampilan"},
     *      summary="Create SaranaPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/SaranaPelatihanKeterampilan/properties/id_sarana"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/SaranaPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
*              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."}))
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

        $saranapelatihanketerampilan = SaranaPelatihanKeterampilan::create($request->all());
        if ($saranapelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $saranapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/saranapelatihanketerampilan/{id}",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="Update SaranaPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="SaranaPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_sarana", ref="#/components/schemas/SaranaPelatihanKeterampilan/properties/id_sarana"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/SaranaPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_sarana", type="array", @OA\Items(example={"Id_sarana field is required."})),
*              @OA\Property(property="id_pelatihan_keterampilan", type="array", @OA\Items(example={"Id_pelatihan_keterampilan field is required."}))
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

        $saranapelatihanketerampilan = SaranaPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($saranapelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPelatihanKeterampilan berhasil diubah.",
                'data' => $saranapelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/saranapelatihanketerampilan/{id}",
     *      tags={"SaranaPelatihanKeterampilan"},
     *      summary="SaranaPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="SaranaPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="SaranaPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saranapelatihanketerampilan = SaranaPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($saranapelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "SaranaPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "SaranaPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
