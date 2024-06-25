<?php

namespace App\Http\Controllers;

use App\Models\DataDosen;
use App\Models\PendidikanDosen;
use App\Models\JabatanDosen;
use App\Models\MinatPenelitian;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DataDosenController extends Controller
{
    public function index()
    {
        return DataDosen::with('pendidikanDosen.sarjana', 'jabatanDosen', 'minatPenelitian')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nidn' => 'required|string|max:20|unique:data_dosen,nidn',
            'nip' => 'required|string|max:20|unique:data_dosen,nip',
            'email' => 'required|string|email|max:255|unique:data_dosen,email',
            'no_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:pria,wanita',
            'alamat' => 'required|string',
            's1_jurusan' => 'nullable|string',
            's2_jurusan' => 'nullable|string',
            's3_jurusan' => 'nullable|string',
            'fungsional' => 'required|string',
            'struktural' => 'required|string',
            'status_pekerjaan' => 'required|string|in:tetap,tidak tetap',
            'status_keaktifan' => 'required|string|in:aktif,tidak aktif,tugas belajar',
            'minat_penelitian' => 'required|string',
        ]);

        // Jika ada file foto, simpan file tersebut
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $data['foto'] = basename($path);
            $data['foto_url'] = Storage::url($path); // Generate URL that can be used in frontend
        }

        // Buat entri baru untuk JabatanDosen
        $jabatanDosen = JabatanDosen::create([
            'fungsional' => $data['fungsional'],
            'struktural' => $data['struktural'],
            'status_pekerjaan' => $data['status_pekerjaan'],
            'status_keaktifan' => $data['status_keaktifan'],
        ]);

        // Buat entri baru untuk MinatPenelitian
        $minatPenelitian = MinatPenelitian::create([
            'nama' => $data['minat_penelitian']
        ]);

        // Buat DataDosen
        $dataDosen = DataDosen::create([
            'id_user' => $data['id_user'],
            'nama' => $data['nama'],
            'foto' => $data['foto'] ?? null, // Menggunakan null jika tidak ada foto
            'foto_url' => $data['foto_url'] ?? null,
            'nidn' => $data['nidn'],
            'nip' => $data['nip'],
            'email' => $data['email'],
            'no_telepon' => $data['no_telepon'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'id_jabatan_dosen' => $jabatanDosen->id,
            'id_minat_penelitian' => $minatPenelitian->id,
        ]);

        // Proses pendidikan S1
        if (isset($data['s1_jurusan']) && !empty($data['s1_jurusan'])) {
            PendidikanDosen::create([
                'id_dosen' => $dataDosen->id,
                'jurusan' => $data['s1_jurusan'],
                'id_sarjana' => 1, // ID untuk S1
            ]);
        }

        // Proses pendidikan S2
        if (isset($data['s2_jurusan']) && !empty($data['s2_jurusan'])) {
            PendidikanDosen::create([
                'id_dosen' => $dataDosen->id,
                'jurusan' => $data['s2_jurusan'],
                'id_sarjana' => 2, // ID untuk S2
            ]);
        }

        // Proses pendidikan S3
        if (isset($data['s3_jurusan']) && !empty($data['s3_jurusan'])) {
            PendidikanDosen::create([
                'id_dosen' => $dataDosen->id,
                'jurusan' => $data['s3_jurusan'],
                'id_sarjana' => 3, // ID untuk S3
            ]);
        }

        // Tanggapi dengan data yang baru disimpan beserta relasi yang diperlukan
        return DataDosen::with('pendidikanDosen.sarjana', 'jabatanDosen', 'minatPenelitian')->find($dataDosen->id);
    }

    public function show($id)
    {
        return DataDosen::with('pendidikanDosen.sarjana', 'jabatanDosen', 'minatPenelitian')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_user' => 'sometimes|exists:users,id',
            'nama' => 'sometimes|string|max:255',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nidn' => 'sometimes|string|max:20|unique:data_dosen,nidn,' . $id,
            'nip' => 'sometimes|string|max:20|unique:data_dosen,nip,' . $id,
            'email' => 'sometimes|string|email|max:255|unique:data_dosen,email,' . $id,
            'no_telepon' => 'sometimes|string|max:15',
            'jenis_kelamin' => 'sometimes|in:pria,wanita',
            'alamat' => 'sometimes|string',
            's1_jurusan' => 'sometimes|nullable|string',
            's2_jurusan' => 'sometimes|nullable|string',
            's3_jurusan' => 'sometimes|nullable|string',
            'fungsional' => 'sometimes|string',
            'struktural' => 'sometimes|string',
            'status_pekerjaan' => 'sometimes|string|in:tetap,tidak tetap',
            'status_keaktifan' => 'sometimes|string|in:aktif,tidak aktif,tugas belajar',
            'minat_penelitian' => 'sometimes|nullable|string',
        ]);

        $dataDosen = DataDosen::findOrFail($id);

        // Update foto jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $data['foto'] = basename($path);
            $data['foto_url'] = Storage::url($path);
        } else {
            $data['foto'] = $dataDosen->foto; // Keep old photo if new one not uploaded
        }

        // Update data dosen
        $dataDosen->update($data);

        // Update atau buat entri baru untuk JabatanDosen
        $dataDosen->jabatanDosen()->updateOrCreate(
            ['id' => $dataDosen->id_jabatan_dosen],
            [
                'fungsional' => $data['fungsional'] ?? $dataDosen->jabatanDosen->fungsional,
                'struktural' => $data['struktural'] ?? $dataDosen->jabatanDosen->struktural,
                'status_pekerjaan' => $data['status_pekerjaan'] ?? $dataDosen->jabatanDosen->status_pekerjaan,
                'status_keaktifan' => $data['status_keaktifan'] ?? $dataDosen->jabatanDosen->status_keaktifan,
            ]
        );

        // Update atau buat entri baru untuk MinatPenelitian
        $dataDosen->minatPenelitian()->updateOrCreate(
            ['id' => $dataDosen->id_minat_penelitian],
            ['nama' => $data['minat_penelitian'] ?? $dataDosen->minatPenelitian->nama]
        );

        // Proses pendidikan S1
        if (isset($data['s1_jurusan'])) {
            PendidikanDosen::updateOrCreate(
                ['id_dosen' => $dataDosen->id, 'id_sarjana' => 1],
                ['jurusan' => $data['s1_jurusan']]
            );
        }

        // Proses pendidikan S2
        if (isset($data['s2_jurusan'])) {
            PendidikanDosen::updateOrCreate(
                ['id_dosen' => $dataDosen->id, 'id_sarjana' => 2],
                ['jurusan' => $data['s2_jurusan']]
            );
        }

        // Proses pendidikan S3
        if (isset($data['s3_jurusan'])) {
            PendidikanDosen::updateOrCreate(
                ['id_dosen' => $dataDosen->id, 'id_sarjana' => 3],
                ['jurusan' => $data['s3_jurusan']]
            );
        }

        return DataDosen::with('pendidikanDosen.sarjana', 'jabatanDosen', 'minatPenelitian')->find($dataDosen->id);
    }

    public function destroy($id)
    {
        $dataDosen = DataDosen::findOrFail($id);
        $dataDosen->delete();

        return response()->json(['message' => 'Data dosen deleted successfully']);
    }
}
