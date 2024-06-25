<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'data_mahasiswa';

    protected $fillable = [
        'id_user', 'nama', 'foto', 'tempat', 'tanggal_lahir', 'email', 'telepon', 'jenis_kelamin', 'alamat',
        'nim', 'semester', 'sks', 'angkatan', 'id_fakultas', 'id_prodi', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
