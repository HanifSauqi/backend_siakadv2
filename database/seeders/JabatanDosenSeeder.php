<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JabatanDosen;

class JabatanDosenSeeder extends Seeder
{
    public function run()
    {
        JabatanDosen::create([
            'fungsional' => 'Lektor',
            'struktural' => 'Kepala Program Studi',
            'status_pekerjaan' => 'Tetap',
            'status_keaktifan' => 'Aktif',
        ]);

        JabatanDosen::create([
            'fungsional' => 'Guru Besar',
            'struktural' => 'Dekan',
            'status_pekerjaan' => 'Tetap',
            'status_keaktifan' => 'Aktif',
        ]);
    }
}
