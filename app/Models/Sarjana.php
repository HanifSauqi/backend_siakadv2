<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarjana extends Model
{
    use HasFactory;

    protected $table = 'sarjana';

    protected $fillable = [
        'nama',
    ];
}
