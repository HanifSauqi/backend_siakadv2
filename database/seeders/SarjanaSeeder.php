<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sarjana;

class SarjanaSeeder extends Seeder
{
    public function run()
    {
        Sarjana::create(['nama' => 'Sarjana Komputer']);
        Sarjana::create(['nama' => 'Magister Komputer']);
        Sarjana::create(['nama' => 'Doktor Komputer']);
    }
}
