<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::with('fakultas')->get();
        return response()->json($prodi);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'id_fakultas' => 'required|exists:fakultas,id',
        ]);

        $prodi = Prodi::create($data);

        return response()->json($prodi, 201);
    }

    public function show($id)
    {
        $prodi = Prodi::with('fakultas')->findOrFail($id);
        return response()->json($prodi);
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $data = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'id_fakultas' => 'sometimes|exists:fakultas,id',
        ]);

        $prodi->update($data);

        return response()->json($prodi);
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return response()->json(['message' => 'Prodi deleted successfully']);
    }
}
