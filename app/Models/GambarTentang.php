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

    public static function GenerateID()
    {

        $prefix = "GBRTENTANG" . date('Ymd');
        $lastID = GambarTentang::where('id_gambar_tentang', 'like', $prefix . '%')->max('id_gambar_tentang');

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