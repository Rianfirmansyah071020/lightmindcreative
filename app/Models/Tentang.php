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


    public static function GenerateID()
    {

        $prefix = "TENTANG" . date('Ymd');
        $lastID = Tentang::where('id_tentang', 'like', $prefix . '%')->max('id_tentang');

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