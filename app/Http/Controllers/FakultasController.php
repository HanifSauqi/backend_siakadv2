<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    // Mendapatkan semua fakultas
    public function index()
    {
        $fakultas = Fakultas::with('prodi')->get();
        return response()->json($fakultas);
    }

    // Mendapatkan satu fakultas berdasarkan ID
    public function show($id)
    {
        $fakultas = Fakultas::with('prodi')->find($id);

        if (!$fakultas) {
            return response()->json(['message' => 'Fakultas not found'], 404);
        }

        return response()->json($fakultas);
    }

    // Membuat fakultas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fakultas = Fakultas::create($request->all());
        return response()->json($fakultas, 201);
    }

    // Mengupdate fakultas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fakultas = Fakultas::find($id);

        if (!$fakultas) {
            return response()->json(['message' => 'Fakultas not found'], 404);
        }

        $fakultas->update($request->all());
        return response()->json($fakultas);
    }

    // Menghapus fakultas
    public function destroy($id)
    {
        $fakultas = Fakultas::find($id);

        if (!$fakultas) {
            return response()->json(['message' => 'Fakultas not found'], 404);
        }

        $fakultas->delete();
        return response()->json(['message' => 'Fakultas deleted successfully']);
    }
}
