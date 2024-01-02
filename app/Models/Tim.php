<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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


    public static function CreateTim($data)
    {


        $create = Tim::create([
            'id_tim' => $data['id_tim'],
            'id_user' => Session::get('id_user'),
            'id_bidang_tim' => $data['id_bidang_tim'],
            'nama_tim' => $data['nama_tim'],
            'jenis_kelamin_tim' => $data['jenis_kelamin_tim'],
            'alamat_tim' => $data['alamat_tim'],
            'nomor_hp_tim' => $data['nomor_hp_tim'],
            'status_tim' => $data['status_tim'],
            'file_gambar_tim' => $data['file'],
        ]);

        $createUser = User::create([
            'id_user' => User::GenerateID(),
            'kode_user' => Session::get('id_user'),
            'id_tim' => $data['id_tim'],
            'email' => $data['email'],
            'password' => $data['password'],
            'level_user' => $data['level_user'],
            'status_user' => $data['status_user'],
        ]);

        $sukses = [
            $create,
            $createUser
        ];

        return $sukses;
    }



    public static function DeleteTim($id_tim, $id_user)
    {

        $deleteTim = Tim::where('id_tim', $id_tim)->delete();
        $deleteUser = User::where('id_user', $id_user)->delete();

        $sukses = [
            $deleteTim, $deleteUser
        ];


        return $sukses;
    }


    public static function UpdateTim($data, $id_tim, $id_user)
    {

        $update = Tim::where('id_tim', $id_tim)->update([
            'id_user' => $id_user,
            'id_bidang_tim' => $data['id_bidang_tim'],
            'nama_tim' => $data['nama_tim'],
            'jenis_kelamin_tim' => $data['jenis_kelamin_tim'],
            'alamat_tim' => $data['alamat_tim'],
            'nomor_hp_tim' => $data['nomor_hp_tim'],
            'status_tim' => $data['status_tim'],
            'file_gambar_tim' => $data['file'],
        ]);

        $updateUser = User::where('id_user', $id_user)->update([
            'email' => $data['email'],
            'password' => $data['password'],
            'level_user' => $data['level_user'],
            'status_user' => $data['status_user'],

        ]);


        $sukses = [
            $update,
            $updateUser
        ];

        return $sukses;
    }


    public static function SettingProfile($data, $id_tim, $id_user)
    {

        $update = Tim::where('id_tim', $id_tim)->update([
            'id_user' => $id_user,
            'id_bidang_tim' => $data['id_bidang_tim'],
            'nama_tim' => $data['nama_tim'],
            'jenis_kelamin_tim' => $data['jenis_kelamin_tim'],
            'alamat_tim' => $data['alamat_tim'],
            'nomor_hp_tim' => $data['nomor_hp_tim'],
            'file_gambar_tim' => $data['file'],
        ]);

        $updateUser = User::where('id_user', $id_user)->update([
            'email' => $data['email'],
            'password' => $data['password'],

        ]);


        $sukses = [
            $update,
            $updateUser
        ];

        return $sukses;
    }
}
