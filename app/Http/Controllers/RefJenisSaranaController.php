<?php

namespace App\Http\Controllers;

use App\Models\RefJenisSarana;
use App\Services\RefJenisSaranaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefJenisSaranaController extends Controller
{

    protected $service;

    public function __construct()
    {
        $this->service = new RefJenisSaranaService();
    }


    public function index(Request $request)
    {
        $data = $request->toArray();
        $dt = $this->service->search($data, $request->url());

        return response()->json([
            'success' => true,
            'message' => "Process Success!",
            'data' => $dt
        ], 200);
    }


    public function dropdown(Request $request)
    {
        $col = ($request->has("sel_col")) ? explode(",", $request->sel_col) : ["identitas_id"];
        $columns[] = "id";
        foreach ($col as $c) {
            $columns[] = $c;
        }

        $data = RefJenisSarana::select($columns);
        if ($request->has("filter_col") && $request->has("filter_val")) {
            $fcol = explode(",", $request->filter_col);
            $fval = explode(",", $request->filter_val);
            for ($i = 0; $i < count($fcol); $i++) {
                $filter_val = ($fval[$i]) ? $fval[$i] : "";
                $data = $data->where($fcol[$i], "like", "%" . $filter_val . "%");
            }
        }
        $RefJenisSarana = $data->get();

        return response()->json($RefJenisSarana);
    }

    public function schema(Request $request)
    {
        $fields = DB::select('describe ref_jenis_sarana');
        $schema = [
            'name' => 'RefJenisSaranaPortir',
            'module' => 'kepribadian',
            'primary_key' => 'id_jenissarana',
            'api' => [
                'endpoint' => 'jenis-sarana',
                'url' => '/jenis-sarana'
            ],
            'scheme' => array_values($fields),
        ];
        return response()->json($schema);
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

    ////// SHOW, STORE, UPDATE, DESTROY (CRUD)



    public function show($id)
    {
        $dt = RefJenisSarana::where('id_jenissarana', $id)->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => "Process Success!",
            'data' => $dt
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenissarana' => 'required',
            'keterangan' => 'required'
        ]);

        try {
            #$user = Auth::user();
            $dt = new RefJenisSarana();

            $dt->jenissarana = $request->jenissarana;
            $dt->keterangan = $request->keterangan;
            $dt->updateterakhir = date('Y-m-d H:i:s');
            #$dt->updateoleh = $user['preferred_username'];
            $dt->save();

            return response()->json([
                'success' => true,
                'message' => "Process Success!",
                'data' => $dt
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Process Fail!",
                'data' => $th->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            # $user = Auth::user();
            $dt = RefJenisSarana::findOrFail($id);
            $dt->jenissarana = $request->jenissarana;
            $dt->keterangan = $request->keterangan;
            $dt->updateterakhir = date('Y-m-d H:i:s');
            #$dt->updateoleh = $user['preferred_username'];
            $dt->save();

            return response()->json([
                'success' => true,
                'message' => "Process Success!",
                'data' => $dt
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Process Fail!",
                'data' => $th->getMessage()
            ], 400);
        }
    }


    public function destroy($id)
    {
        $rupbarang = RefJenisSarana::where('id_jenissarana', $id)->firstOrFail();

        if ($rupbarang->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Process Success!"
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Process Fail!"
            ], 400);
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
