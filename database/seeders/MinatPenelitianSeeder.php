<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MinatPenelitian;

class MinatPenelitianSeeder extends Seeder
{
    public function run()
    {
        MinatPenelitian::create(['nama' => 'Artificial Intelligence']);
        MinatPenelitian::create(['nama' => 'Machine Learning']);
    }
}
