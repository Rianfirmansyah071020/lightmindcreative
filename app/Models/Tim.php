<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Tim extends Model
{
    use HasFactory;

    protected $table = 'tb_tim';


    protected $fillable = [
        'id_tim',
        'id_user',
        'id_bidang_tim',
        'nama_tim',
        'jenis_kelamin_tim',
        'alamat_tim',
        'nomor_hp_tim',
        'status_tim',
        'file_gambar_tim'
    ];



    public static function GenerateID()
    {

        $prefix = "TIM" . date('Ymd');
        $lastID = DB::table('tb_tim')->where('id_tim', 'like', $prefix . '%')->max('id_tim');

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