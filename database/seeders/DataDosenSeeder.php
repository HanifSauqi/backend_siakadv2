<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataDosen;

class DataDosenSeeder extends Seeder
{
    public function run()
    {
        DataDosen::create([
            'id_user' => 1,
            'nama' => 'Dr. John Doe',
            'foto' => 'johndoe.jpg',
            'nidn' => '1234567890',
            'nip' => '0987654321',
            'email' => 'johndoe@example.com',
            'no_telepon' => '08123456789',
            'jenis_kelamin' => 'pria',
            'alamat' => 'Jl. Merdeka No. 1',
            'id_pendidikan_dosen' => null, // Perbolehkan null
            'id_jabatan_dosen' => 1,
            'id_minat_penelitian' => 1,
        ]);
    }
}
