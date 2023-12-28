<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialMediaTim extends Model
{
    use HasFactory;

    protected $table = 'tb_sosial_media_tim';

    protected $fillable = [
        'id_sosial_media_tim',
        'id_user',
        'id_tim',
        'nama_sosial_media_tim',
        'link_sosial_media_tim',
    ];
}
