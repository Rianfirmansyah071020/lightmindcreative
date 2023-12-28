<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pelayanan';

    protected $fillable = [
        'id_pelayanan',
        'id_user',
        'judul_pelayanan',
        'deskripsi_judul_pelayanan',
        'status_pelayanan',
    ];
}
