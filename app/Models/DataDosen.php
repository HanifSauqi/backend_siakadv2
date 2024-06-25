<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDosen extends Model
{
    use HasFactory;

    protected $table = 'data_dosen';
    
    protected $fillable = [
        'id_user',
        'nama',
        'foto',
        'nidn',
        'nip',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'alamat',
        'id_jabatan_dosen',
        'id_minat_penelitian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pendidikanDosen()
    {
        return $this->hasMany(PendidikanDosen::class, 'id_dosen');
    }

    public function jabatanDosen()
    {
        return $this->belongsTo(JabatanDosen::class, 'id_jabatan_dosen');
    }

    public function minatPenelitian()
    {
        return $this->belongsTo(MinatPenelitian::class, 'id_minat_penelitian');
    }
}
