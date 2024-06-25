<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendidikanDosen;

class PendidikanDosenSeeder extends Seeder
{
    public function run()
    {
        PendidikanDosen::create([
            'id_dosen' => 1,
            'jurusan' => 'Teknik Informatika',
            'id_sarjana' => 1,
        ]);

        PendidikanDosen::create([
            'id_dosen' => 1,
            'jurusan' => 'Manajemen Informatika',
            'id_sarjana' => 2,
        ]);

        PendidikanDosen::create([
            'id_dosen' => 1,
            'jurusan' => 'Ilmu Komputer',
            'id_sarjana' => 3,
        ]);
    }
}
