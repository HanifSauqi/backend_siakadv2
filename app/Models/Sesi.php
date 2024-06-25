<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi';

    protected $fillable = ['waktu', 'nama'];

    public function jadwalMatkul()
    {
        return $this->hasMany(JadwalMatkul::class, 'id_sesi');
    }
}
