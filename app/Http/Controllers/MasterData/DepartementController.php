<?php

namespace App\Http\Controllers\MasterData;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        return view('master-data.departement.index');
    }

    public function create()
    {
        $data = Departement::orderBy('departement','asc')->get();
        return view('master-data.departement.display', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:10|min:1|unique:departments',
            'name' => 'required|max:255|min:1',
        ]);
        $data = Departement::create($request->all());
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil menambahkan data ' . $data->name,
            'status' => $data ? 200 : 400,
        ]);
    }

    public function show($type)
    {
        $count = Departement::count();
        if ($count > 0) {
            $last_data = Departement::latest('id')->first();
            $last_data_code = substr($last_data->data_code, -3);
            if (str_contains($last_data_code, '00')) {
                $sequence = substr($last_data_code, -1) + 1;
            } elseif (str_contains($last_data_code, '0')) {
                $sequence = substr($last_data_code, -2) + 1;
            } else {
                $sequence = $last_data->id + 1;
            }
        } else {
            $sequence = 1;
        }

        $output = '';
        if ($sequence == 1) {
            $sequence = 1;
        }
        if (strlen($sequence) == 1) {
            $output = '00' . $sequence;
        } elseif (strlen($sequence) == 2) {
            $output = '0' . $sequence;
        } else {
            $output = $sequence;
        }
        $code_data = 'DPT-' . $output;
        return response()->json([
            'data' => $code_data,
            'status' => 200,
        ]);
    }

    public function edit($id)
    {
        $data = Departement::findOrFail($id);
        return response()->json([
            'data' => $data,
            'status' => $data ? 200 : 400,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Departement::findOrFail($id);
        $data->update($request->all());
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengubah data ' . $data->name,
            'status' => $data ? 200 : 400,
        ]);
    }

    public function destroy($id)
    {
        Departement::destroy($id);
        return response()->json([
            'data' => $id,
            'message' => 'Berhasil menghapus data Department',
            'status' => 200,
        ]);
    }
}
