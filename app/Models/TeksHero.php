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


    public static function GenerateID()
    {

        $prefix = "TKHERO" . date('Ymd');
        $lastID = TeksHero::where('id_teks_hero', 'like', $prefix . '%')->max('id_teks_hero');

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
