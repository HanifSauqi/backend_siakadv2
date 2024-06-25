<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        Prodi::create(['nama' => 'Teknik Informatika', 'id_fakultas' => 1]);
        Prodi::create(['nama' => 'Sistem Informasi', 'id_fakultas' => 1]);
        Prodi::create(['nama' => 'Manajemen', 'id_fakultas' => 2]);
    }
}
