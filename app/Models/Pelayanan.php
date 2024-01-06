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


    public static function GenerateID()
    {

        $prefix = "PELAYANAN" . date('Ymd');
        $lastID = Pelayanan::where('id_pelayanan', 'like', $prefix . '%')->max('id_pelayanan');

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