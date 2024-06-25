<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalMatkul;

class JadwalMatkulSeeder extends Seeder
{
    public function run()
    {
        JadwalMatkul::create(['hari' => 'Senin', 'id_sesi' => 1, 'ruang' => 'HU201']);
        JadwalMatkul::create(['hari' => 'Rabu', 'id_sesi' => 2, 'ruang' => 'HU201']);
        JadwalMatkul::create(['hari' => 'Jumat', 'id_sesi' => 3, 'ruang' => 'HU203']);
    }
}
