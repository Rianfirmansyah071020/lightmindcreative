<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Aktifitas extends Model
{
    use HasFactory;


    protected $table = 'tb_aktifitas';


    protected $fillable = [
        'id_aktifitas',
        'id_user',
        'aktifitas',
    ];


    public static function GenerateID()
    {

        $prefix = "AKTIFITAS" . date('Ymd');
        $lastID = DB::table('tb_aktifitas')->where('id_aktifitas', 'like', $prefix . '%')->max('id_aktifitas');

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




    public static function CreateAktifitas($aktifitas)
    {
        $create = Aktifitas::create([
            'id_aktifitas' => Aktifitas::GenerateID(),
            'id_user' => Session::get('id_user'),
            'aktifitas' => $aktifitas,
        ]);


        return $create;
    }
}
