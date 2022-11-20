<?php

namespace App\Http\Controllers;

use App\Models\Dati2;
use App\Services\Dati2Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dati2Controller extends Controller
{

    protected $service;
    protected $rules;

    public function __construct()
    {
        $this->service = new Dati2Service();
        $this->rules = array(
            'deskripsi' => 'required',
            'id_provinsi' => 'required',
            'status' => 'required',
            'id_bps' => 'nullable',
        );
    }

    /**
     * @OA\Get(
     *      path="/dati2",
     *      tags={"Dati2"},
     *      summary="List of Dati2",
     *      @OA\Parameter(in="query", required=false, name="page", @OA\Schema(type="int"), description="Current page", example=1),
     *      @OA\Parameter(in="query", required=false, name="per_page", @OA\Schema(type="int"), description="Total per page", example=10),
     *      @OA\Parameter(in="query", required=false, name="keyword", @OA\Schema(type="string"), description="Keyword", example="john"),
     *      @OA\Parameter(in="query", required=false, name="sort", @OA\Schema(type="string"), description="Sort by column", example="deskripsi:desc"),
     *      @OA\Parameter(in="query", required=false, name="column", @OA\Schema(type="string"), description="Columns selected", example="deskripsi,id_provinsi,status,id_bps"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 data successfully loaded"),
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
        $dati2 = $this->service->search($data, $request->url());

        return response()->json($dati2);
    }

    /**
     * @OA\Get(
     *      path="/dati2/dropdown",
     *      tags={"Dati2"},
     *      summary="List of Dati2",
     *      @OA\Parameter(in="query", required=false, name="sel_col", @OA\Schema(type="string"), description="select coloumn", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_col", @OA\Schema(type="string"), description="filter column", example=""),
     *      @OA\Parameter(in="query", required=false, name="filter_val", @OA\Schema(type="string"), description="filter value", example=""),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 data successfully loaded"),
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
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["deskripsi"];
        $columns[] = "id_dati2";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = Dati2::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $dati2 = $data->get();

        return response()->json($dati2);
    }

    /**
     * @OA\Get(
     *      path="/dati2/schema",
     *      tags={"Dati2"},
     *      summary="Schema of Dati2",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 schema successfully loaded"),
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
                'Field' => 'id_dati2',
                'Type' => 'INT()',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => NULL,
                'Extra' => ' UNSIGNED AUTO_INCREMENT',
            ),
            1 =>
            array(
                'Field' => 'deskripsi',
                'Type' => 'VARCHAR(50)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            2 =>
            array(
                'Field' => 'id_provinsi',
                'Type' => 'VARCHAR(35)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
            3 =>
            array(
                'Field' => 'status',
                'Type' => 'TINYINT(1)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => '0',
                'Extra' => '',
            ),
            4 =>
            array(
                'Field' => 'status_download',
                'Type' => 'TINYINT(1)',
                'Null' => 'NO',
                'Key' => NULL,
                'Default' => '0',
                'Extra' => '',
            ),
            5 =>
            array(
                'Field' => 'id_bps',
                'Type' => 'VARCHAR(4)',
                'Null' => 'YES',
                'Key' => NULL,
                'Default' => NULL,
                'Extra' => '',
            ),
        );
        $schema = array(
            'name' => 'dati2',
            'module' => 'lain-lain',
            'primary_key' => 'id_dati2',
            'api' => [
                'endpoint' => 'pembinaan-kepribadian',
                'url' => '/dati2'
            ],
            'scheme' => array_values($fields),
        );
        return response()->json($schema);
    }

    /**
     * @OA\Get(
     *      path="/dati2/{id}",
     *      tags={"Dati2"},
     *      summary="Dati2 details",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="string"), description="Dati2 ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 successfully loaded"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dati2 = Dati2::where('id_dati2', $id)->firstOrFail();
        if (!$dati2->exists) {
            return response()->json([
                'status' => 500,
                'message' => "Dati2 tidak dapat ditemukan.",
                'data' => null
            ]);
        }

        $data = $this->service->show($dati2);
        //$collection = collect($dati2);
        //$merge = $collection->merge($data);    
        return response()->json([
            'status' => 200,
            'message' => "Dati2 ditemukan.",
            'data' => $data //$merge->all()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/dati2",
     *      tags={"Create Dati2"},
     *      summary="Create Dati2",
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="deskripsi", ref="#/components/schemas/Dati2/properties/deskripsi"),
     *              @OA\Property(property="id_provinsi", ref="#/components/schemas/Dati2/properties/id_provinsi"),
     *              @OA\Property(property="status", ref="#/components/schemas/Dati2/properties/status"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="deskripsi", type="array", @OA\Items(example={"Deskripsi field is required."})),
     *              @OA\Property(property="id_provinsi", type="array", @OA\Items(example={"Id_provinsi field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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


        $dati2 = Dati2::create($request->all());
        if ($dati2->exists) {
            return response()->json([
                'status' => 200,
                'message' => "Dati2 berhasil ditambahkan.",
                'data' => $dati2
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Dati2 tidak dapat ditambahkan.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Put(
     *      path="/dati2/{id}",
     *      tags={"Dati2"},
     *      summary="Update Dati2",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Dati2 ID"),
     *      @OA\RequestBody(
     *         description="Body",
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="deskripsi", ref="#/components/schemas/Dati2/properties/deskripsi"),
     *              @OA\Property(property="id_provinsi", ref="#/components/schemas/Dati2/properties/id_provinsi"),
     *              @OA\Property(property="status", ref="#/components/schemas/Dati2/properties/status"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 successfully updated"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="error",
     *          @OA\JsonContent(
     *              @OA\Property(property="deskripsi", type="array", @OA\Items(example={"Deskripsi field is required."})),
     *              @OA\Property(property="id_provinsi", type="array", @OA\Items(example={"Id_provinsi field is required."})),
     *              @OA\Property(property="status", type="array", @OA\Items(example={"Status field is required."}))
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


        $dati2 = Dati2::where('id_dati2', $id)->firstOrFail();
        if ($dati2->update($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => "Dati2 berhasil diubah.",
                'data' => $dati2
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Dati2 tidak dapat diubah.",
                'data' => null
            ]);
        }
    }


    /**
     * @OA\Delete(
     *      path="/dati2/{id}",
     *      tags={"Dati2"},
     *      summary="Dati2 Removal",
     *      @OA\Parameter(in="path", required=true, name="id", @OA\Schema(type="id"), description="Dati2 ID"),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Dati2 deleted"),
     *          ),
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dati2 = Dati2::where('id_dati2', $id)->firstOrFail();

        if ($dati2->delete()) {
            return response()->json([
                'status' => 200,
                'message' => "Dati2 berhasil dihapus.",
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Dati2 tidak dapat dihapus.",
                'data' => null
            ]);
        }
    }
}
