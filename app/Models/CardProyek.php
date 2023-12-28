<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardProyek extends Model
{
    use HasFactory;

    protected $table = 'tb_card_proyek';

    protected $fillable = [
        'id_card_proyek',
        'id_user',
        'id_proyek',
        'file_gambar_card_proyek',
        'judul_card_proyek',
        'deskripsi_judul_card_proyek',
        'deskripsi_card_proyek',
        'link_card_proyek',
    ];
}