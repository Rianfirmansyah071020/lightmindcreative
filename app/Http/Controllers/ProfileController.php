<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
