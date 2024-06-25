<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMatkul extends Model
{
    use HasFactory;

    protected $table = 'jadwal_matkul'; 

    protected $fillable = ['hari', 'id_sesi', 'ruang'];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi');
    }
}
