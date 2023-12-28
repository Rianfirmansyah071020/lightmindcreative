<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeksHero extends Model
{
    use HasFactory;

    protected $table = 'tb_teks_hero';

    protected $fillable = [
        'id_teks_hero',
        'id_gambar_hero',
        'id_user',
        'judul_teks_hero',
        'deskripsi_teks_hero'
    ];
}
