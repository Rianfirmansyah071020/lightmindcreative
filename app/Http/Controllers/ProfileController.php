<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses profile');
        }

        $data['timById'] = DB::table('tb_tim')->join('tb_bidang_tim', 'tb_bidang_tim.id_bidang_tim', '=', 'tb_tim.id_bidang_tim')->where('tb_tim.id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        return view('pages.dashboard.profile.index', $data);
    }


    public function viewSetting(Request $request)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('edit profile');
        }

        $data['bidang'] = DB::table('tb_bidang_tim')->get();

        $data['timById'] = DB::table('tb_tim')->join('tb_bidang_tim', 'tb_bidang_tim.id_bidang_tim', '=', 'tb_tim.id_bidang_tim')->where('tb_tim.id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        return view('pages.dashboard.profile.setting', $data);
    }


    public function SettingProfile(Request $request, string $id, $id_user)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('setting profile');
        }

        $dataTim = DB::table('tb_tim')->where('id_tim', $id)->first();
        $dataUser = DB::table('users')->where('id_user', $id_user)->first();

        if ($request->file('file_gambar_tim') == null) {
            $file = $dataTim->file_gambar_tim;
        } else {
            $nama_file = $request->file('file_gambar_tim')->getClientOriginalName();
            $file = $request->file('file_gambar_tim')->move('images/tim', $nama_file);
            $file = 'images/tim/' . $nama_file;
        }


        if ($request->input('password') == null) {
            $password = $dataUser->password;
        } else {
            $password = Hash::make($request->input('password'));
        }


        $data = [
            'id_bidang_tim' => $request->input('id_bidang_tim'),
            'id_user' => Session::get('id_user'),
            'nama_tim' => $request->input('nama_tim'),
            'jenis_kelamin_tim' => $request->input('jenis_kelamin_tim'),
            'alamat_tim' => $request->input('alamat_tim'),
            'nomor_hp_tim' => $request->input('nomor_hp_tim'),
            'file' => $file,
            'email' => $request->input('email'),
            'password' => $password,
        ];

        if (Tim::SettingProfile($data, $id, $id_user)) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Profile berhasil di setting'
            ]);
            return redirect()->route('profile');
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Tim gagal di setting'
            ]);
            return redirect()->route('profile');
        }
    }
}
