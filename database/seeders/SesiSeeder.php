<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sesi;

class SesiSeeder extends Seeder
{
    public function run()
    {
        Sesi::create(['waktu' => '07:15 - 8:55', 'nama' => 'Sesi 1']);
        Sesi::create(['waktu' => '09:15 - 10:55', 'nama' => 'Sesi 2']);
        Sesi::create(['waktu' => '12:15 - 13:55', 'nama' => 'Sesi 3']);
        Sesi::create(['waktu' => '14:15 - 15:55', 'nama' => 'Sesi 3']);
    }
}
