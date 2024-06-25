<?php

namespace App\Http\Controllers;

use App\Models\DataMatkul;
use App\Models\JadwalMatkul;
use Illuminate\Http\Request;

class DataMatkulController extends Controller
{
    public function index()
    {
        return DataMatkul::with('dosen', 'jadwal.sesi')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:20',
            'sks' => 'required|integer',
            'semester' => 'required|string',
            'id_data_dosen' => 'required|exists:data_dosen,id',
            'jadwal.hari' => 'required|string',
            'jadwal.id_sesi' => 'required|exists:sesi,id',
            'jadwal.ruang' => 'required|string|max:50',
            'jenis' => 'required|in:wajib,pilihan',
        ]);

        // Create JadwalMatkul entry
        $jadwalMatkul = JadwalMatkul::create($data['jadwal']);

        // Set id_jadwal_matkul in $data
        $data['id_jadwal_matkul'] = $jadwalMatkul->id;

        // Remove jadwal from $data to avoid errors
        unset($data['jadwal']);

        // Create DataMatkul entry
        $dataMatkul = DataMatkul::create($data);

        return response()->json($dataMatkul->load('dosen', 'jadwal.sesi'), 201);
    }

    public function show($id)
    {
        $dataMatkul = DataMatkul::with('dosen', 'jadwal.sesi')->findOrFail($id);
        return response()->json($dataMatkul);
    }

    public function update(Request $request, $id)
    {
        $dataMatkul = DataMatkul::findOrFail($id);

        $data = $request->validate([
            'id_user' => 'sometimes|exists:users,id',
            'nama' => 'sometimes|string|max:255',
            'kode' => 'sometimes|string|max:20',
            'sks' => 'sometimes|integer',
            'semester' => 'sometimes|string',
            'id_data_dosen' => 'sometimes|exists:data_dosen,id',
            'jadwal.hari' => 'sometimes|string',
            'jadwal.id_sesi' => 'sometimes|exists:sesi,id',
            'jadwal.ruang' => 'sometimes|string|max:50',
            'jenis' => 'sometimes|in:wajib,pilihan',
        ]);

        if (isset($data['jadwal'])) {
            $dataMatkul->jadwal->update($data['jadwal']);
            unset($data['jadwal']);
        }

        $dataMatkul->update($data);

        return response()->json($dataMatkul->load('dosen', 'jadwal.sesi'));
    }

    public function destroy($id)
    {
        $dataMatkul = DataMatkul::findOrFail($id);
        $dataMatkul->delete();

        return response()->json(['message' => 'Data mata kuliah deleted successfully']);
    }
}
