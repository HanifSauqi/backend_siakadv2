<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataMahasiswa;

class DataMahasiswaSeeder extends Seeder
{
    public function run()
    {
        DataMahasiswa::create([
            'id_user' => 1,
            'nama' => 'John Doe',
            'foto' => 'johndoe.jpg',
            'tempat' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'email' => 'john.doe12@example.com',
            'telepon' => '08123456789',
            'jenis_kelamin' => 'pria',
            'alamat' => 'Jl. Merdeka No. 1',
            'nim' => '0909008',
            'semester' => '1',
            'sks' => 54,
            'angkatan' => '2020',
            'id_fakultas' => 1,
            'id_prodi' => 1,
            'status' => 'aktif'
        ]);
    }
}
