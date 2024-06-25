<?php

namespace App\Http\Controllers;

use App\Models\DataMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        return DataMahasiswa::with('fakultas', 'prodi')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|string|email|max:255|unique:data_mahasiswa,email',
            'telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:pria,wanita',
            'alamat' => 'required|string',
            'nim' => 'required|string|max:20|unique:data_mahasiswa,nim',
            'semester' => 'required|string',
            'angkatan' => 'required|string',
            'id_fakultas' => 'required|exists:fakultas,id',
            'id_prodi' => 'required|exists:prodi,id',
            'status' => 'required|in:aktif,tidak aktif',
        ]);
    
        // Jika ada file foto, simpan file tersebut
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $data['foto'] = basename($path);
            $data['foto_url'] = Storage::url($path); // Generate URL that can be used in frontend
        }
    
        $dataMahasiswa = DataMahasiswa::create($data);
    
        return response()->json($dataMahasiswa, 201);
    }
    
    public function show($id)
    {
        $dataMahasiswa = DataMahasiswa::with('fakultas', 'prodi')->findOrFail($id);
        return response()->json(['data' => $dataMahasiswa], 200);
    }

    public function update(Request $request, $id)
    {
        $dataMahasiswa = DataMahasiswa::findOrFail($id);
    
        $data = $request->validate([
            'id_user' => 'sometimes|exists:users,id',
            'nama' => 'sometimes|string|max:255',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'sometimes|string',
            'tanggal_lahir' => 'sometimes|date',
            'email' => 'sometimes|string|email|max:255|unique:data_mahasiswa,email,' . $id,
            'telepon' => 'sometimes|string|max:15',
            'jenis_kelamin' => 'sometimes|in:pria,wanita',
            'alamat' => 'sometimes|string',
            'nim' => 'sometimes|string|max:20|unique:data_mahasiswa,nim,' . $id,
            'semester' => 'sometimes|string',
            'angkatan' => 'sometimes|string',
            'id_fakultas' => 'sometimes|exists:fakultas,id',
            'id_prodi' => 'sometimes|exists:prodi,id',
            'status' => 'sometimes|in:aktif,tidak aktif',
        ]);
    
        // Update foto jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            if ($dataMahasiswa->foto) {
                Storage::delete('public/fotos/' . $dataMahasiswa->foto);
            }
            $path = $request->file('foto')->store('public/fotos');
            $data['foto'] = basename($path);
        }
    
        $dataMahasiswa->update($data);
    
        return response()->json(['data' => $dataMahasiswa, 'message' => 'Data mahasiswa berhasil diupdate'], 200);
    }
    

    public function destroy($id)
    {
        $dataMahasiswa = DataMahasiswa::findOrFail($id);
        if ($dataMahasiswa->foto) {
            Storage::delete('public/fotos/' . $dataMahasiswa->foto);
        }
        $dataMahasiswa->delete();

        return response()->json(['message' => 'Data mahasiswa berhasil dihapus'], 200);
    }
}
