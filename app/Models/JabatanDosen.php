<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanDosen extends Model
{
    use HasFactory;

    protected $table = 'jabatan_dosen';

    protected $fillable = [
        'fungsional',
        'struktural',
        'status_pekerjaan',
        'status_keaktifan',
    ];
}
