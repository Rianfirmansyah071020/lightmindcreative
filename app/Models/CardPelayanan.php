<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPelayanan extends Model
{
    use HasFactory;

    protected $table = 'tb_card_pelayanan';

    protected $fillable = [
        'id_card_pelayanan',
        'id_user',
        'id_pelayanan',
        'file_gambar_card_pelayanan',
        'judul_card_pelayanan',
        'deskripsi_judul_card_pelayanan',
        'deskripsi_card_pelayanan',
    ];
}
