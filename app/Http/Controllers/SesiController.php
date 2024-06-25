<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index()
    {
        $sesi = Sesi::all();
        return response()->json($sesi);
    }

    public function show($id)
    {
        $sesi = Sesi::find($id);
        if (is_null($sesi)) {
            return response()->json(['message' => 'Sesi not found'], 404);
        }
        return response()->json($sesi);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'waktu' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $sesi = Sesi::create($validatedData);
        return response()->json($sesi, 201);
    }

    public function update(Request $request, $id)
    {
        $sesi = Sesi::find($id);
        if (is_null($sesi)) {
            return response()->json(['message' => 'Sesi not found'], 404);
        }

        $validatedData = $request->validate([
            'waktu' => 'sometimes|required|string|max:255',
            'nama' => 'sometimes|required|string|max:255',
        ]);

        $sesi->update($validatedData);
        return response()->json($sesi);
    }

    public function destroy($id)
    {
        $sesi = Sesi::find($id);
        if (is_null($sesi)) {
            return response()->json(['message' => 'Sesi not found'], 404);
        }

        $sesi->delete();
        return response()->json(['message' => 'Sesi deleted successfully']);
    }
}
