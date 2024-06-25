<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMatkul extends Model
{
    use HasFactory;

    protected $table = 'data_matkul';

    protected $fillable = [
        'id_user', 'nama', 'kode', 'sks', 'semester', 'id_data_dosen', 'id_jadwal_matkul', 'jenis'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function dosen()
    {
        return $this->belongsTo(DataDosen::class, 'id_data_dosen');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalMatkul::class, 'id_jadwal_matkul');
    }
}
