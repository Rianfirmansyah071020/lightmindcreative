<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'tb_proyek';


    protected $fillable = [
        'id_proyek',
        'id_user',
        'judul_proyek',
        'deskripsi_judul_proyek',
        'status_proyek',

    ];
}
