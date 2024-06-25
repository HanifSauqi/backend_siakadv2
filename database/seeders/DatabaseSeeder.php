<?php

namespace Database\Seeders;

use App\Models\DataMahasiswa;
use App\Models\DataMatkul;
use App\Models\Fakultas;
use App\Models\JadwalMatkul;
use App\Models\Sesi;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([

            DataMatkulSeeder::class,
        ]);
    }
}
