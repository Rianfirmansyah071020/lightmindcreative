<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarTentang extends Model
{
    use HasFactory;

    protected $table = "tb_gambar_tentang";

    protected $fillable = [
        'id_gambar_tentang',
        'id_user',
        'id_tentang',
        'file_gambar_tentang'
    ];
}
