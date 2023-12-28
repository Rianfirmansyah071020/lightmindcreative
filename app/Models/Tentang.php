<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tb_tentang';

    protected $fillable = [
        'id_tentang',
        'id_user',
        'judul_tentang',
        'deskripsi_judul_tentang',
        'deskripsi_tentang',
        'status_tentang',
    ];
}
