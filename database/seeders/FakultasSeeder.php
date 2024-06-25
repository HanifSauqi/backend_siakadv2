<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        Fakultas::create(['nama' => 'Fakultas Teknologi Informasi']);
        Fakultas::create(['nama' => 'Fakultas Ekonomi']);
    }
}
