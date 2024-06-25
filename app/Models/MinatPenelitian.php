<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatPenelitian extends Model
{
    use HasFactory;

    protected $table = 'minat_penelitian';


    protected $fillable = [
        'nama',
    ];
}
