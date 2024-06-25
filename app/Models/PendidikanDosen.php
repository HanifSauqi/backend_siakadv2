<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanDosen extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_dosen';

    protected $fillable = [
        'id_dosen',
        'jurusan',
        'id_sarjana',
    ];

    public function dosen()
    {
        return $this->belongsTo(DataDosen::class, 'id_dosen');
    }

    public function sarjana()
    {
        return $this->belongsTo(Sarjana::class, 'id_sarjana');
    }
}
