<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses dashboard');
        }

        $data['aktifitas'] = DB::table('tb_aktifitas')->where('id_user', Session::get('id_user'))->orderBy('id_aktifitas', 'desc')->where('created_at', '>=', date('Y-m-d'))->get();

        return view("pages.dashboard.index", $data);
    }
}
