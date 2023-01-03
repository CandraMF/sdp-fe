<?php

namespace App\Http\Controllers;

use App\Models\InstrukturPelatihanKeterampilan;
use App\Services\InstrukturPelatihanKeterampilanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstrukturPelatihanKeterampilanController extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new InstrukturPelatihanKeterampilanService();
        $this->rules = array (
  'id_instruktur' => 'required',
  'id_pelatihan_keterampilan' => 'required',
);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpelatihanketerampilan",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="List of InstrukturPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="id_instruktur:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="id_instruktur,id_pelatihan_keterampilan"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan data successfully loaded"),
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
        $instrukturpelatihanketerampilan = $this->service->search($data, $request->url());

        return response()->json($instrukturpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpelatihanketerampilan/dropdown",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="List of InstrukturPelatihanKeterampilan",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["id_instruktur"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = InstrukturPelatihanKeterampilan::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $instrukturpelatihanketerampilan = $data->get();

        return response()->json($instrukturpelatihanketerampilan);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpelatihanketerampilan/schema",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="Schema of InstrukturPelatihanKeterampilan",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan schema successfully loaded"),
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
    'Field' => 'id_instruktur',
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
            'name' => 'instrukturpelatihanketerampilan',
            'module' => 'lain-lain',
            'primary_key' => 'id',
            'api' => [
                'endpoint' => 'pelatihan-keterampilan',
                'url' => '/instrukturpelatihanketerampilan'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/instrukturpelatihanketerampilan/{id}",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="InstrukturPelatihanKeterampilan details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="InstrukturPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instrukturpelatihanketerampilan = InstrukturPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if (!$instrukturpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPelatihanKeterampilan tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($instrukturpelatihanketerampilan);
        //$collection = collect($instrukturpelatihanketerampilan);
        //$merge = $collection->merge($data);
        return response()->json([
            'status' => 200,
            'message' => "InstrukturPelatihanKeterampilan ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/instrukturpelatihanketerampilan",
     *      tags={"Create InstrukturPelatihanKeterampilan"},
     *      summary="Create InstrukturPelatihanKeterampilan",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/InstrukturPelatihanKeterampilan/properties/id_instruktur"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/InstrukturPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
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

        $instrukturpelatihanketerampilan = InstrukturPelatihanKeterampilan::create($request->all());
        if ($instrukturpelatihanketerampilan->exists) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPelatihanKeterampilan berhasil ditambahkan.",
                'data' => $instrukturpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPelatihanKeterampilan tidak dapat ditambahkan.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Put(
     *      path="/instrukturpelatihanketerampilan/{id}",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="Update InstrukturPelatihanKeterampilan",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="InstrukturPelatihanKeterampilan ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", ref="#/components/schemas/InstrukturPelatihanKeterampilan/properties/id_instruktur"),
*              @OA\Property(property="id_pelatihan_keterampilan", ref="#/components/schemas/InstrukturPelatihanKeterampilan/properties/id_pelatihan_keterampilan"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="id_instruktur", type="array", @OA\Items(example={"Id_instruktur field is required."})),
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

        $instrukturpelatihanketerampilan = InstrukturPelatihanKeterampilan::where('id', $id)->firstOrFail();
        if ($instrukturpelatihanketerampilan->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPelatihanKeterampilan berhasil diubah.",
                'data' => $instrukturpelatihanketerampilan
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPelatihanKeterampilan tidak dapat diubah.",
                'data' => null
            ]);
        }

    }


    /**
     * @OA\Delete(
     *      path="/instrukturpelatihanketerampilan/{id}",
     *      tags={"InstrukturPelatihanKeterampilan"},
     *      summary="InstrukturPelatihanKeterampilan Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="InstrukturPelatihanKeterampilan ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="InstrukturPelatihanKeterampilan deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrukturpelatihanketerampilan = InstrukturPelatihanKeterampilan::where('id', $id)->firstOrFail();

        if ($instrukturpelatihanketerampilan->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "InstrukturPelatihanKeterampilan berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "InstrukturPelatihanKeterampilan tidak dapat dihapus.",
                'data' => null
            ]);
        }

    }

}
