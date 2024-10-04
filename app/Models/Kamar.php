<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor',
        'harga',
        'lantai',
        'status',
        'foto_kamar'
    ];
}
