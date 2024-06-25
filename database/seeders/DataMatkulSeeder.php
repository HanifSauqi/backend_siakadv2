<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataMatkul;

class DataMatkulSeeder extends Seeder
{
    public function run()
    {
        DataMatkul::create([
            'id_user' => 1,
            'nama' => 'Algoritma dan Pemrograman',
            'kode' => 'IF101',
            'sks' => 3,
            'semester' => '1',
            'id_data_dosen' => 6,
            'id_jadwal_matkul' => 1,
            'jenis' => 'wajib'
        ]);
    }
}
