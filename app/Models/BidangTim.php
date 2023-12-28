<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class BidangTim extends Model
{
    use HasFactory;


    protected $table = 'tb_bidang_tim';


    protected $fillable = [
        'id_bidang_tim',
        'id_user',
        'nama_bidang_tim',
        'deskripsi_bidang_tim',
    ];

    public static function GenerateID()
    {

        $prefix = "BIDANG" . date('Ymd');
        $lastID = BidangTim::where('id_bidang_tim', 'like', $prefix . '%')->max('id_bidang_tim');

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


    public static function CreateBidang($data)
    {

        foreach ($data->nama_bidang_tim as $key => $value) {
            $create = BidangTim::create([
                'id_bidang_tim' => BidangTim::GenerateID(),
                'id_user' => Session::get('id_user'),
                'nama_bidang_tim' => $value,
                'deskripsi_bidang_tim' => $data->deskripsi_bidang_tim[$key],
            ]);
        }

        return $create;
    }


    public static function DeleteBidang($id)
    {
        $delete = BidangTim::where('id_bidang_tim', $id)->delete();

        return $delete;
    }


    public static function UpdateBidang($data, $id)
    {

        $update = BidangTim::where('id_bidang_tim', $id)->update([
            'id_user' => Session::get('id_user'),
            'nama_bidang_tim' => $data->nama_bidang_tim,
            'deskripsi_bidang_tim' => $data->deskripsi_bidang_tim,
        ]);

        return $update;
    }
}
