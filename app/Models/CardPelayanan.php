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


    public static function GenerateID()
    {

        $prefix = "CPELAYANAN" . date('Ymd');
        $lastID = CardPelayanan::where('id_card_pelayanan', 'like', $prefix . '%')->max('id_card_pelayanan');

        if ($lastID == null) {
            return $prefix . "0000001";
        } else {
            $lastID = str_replace($prefix, '', $lastID);
            $lastID = (int) $lastID;
            $lastID += 1;
            $lastID = str_pad($lastID, 7, '0', STR_PAD_LEFT);
            return $prefix . $lastID;
        }
    }
}