<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarHero extends Model
{
    use HasFactory;

    protected $table = 'tb_gambar_hero';
    protected $fillable = [
        'id_gambar_hero',
        'id_user',
        'file_gambar_hero',
        'status_gambar_hero'
    ];
}
