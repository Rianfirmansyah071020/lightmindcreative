<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses kelola tim');
        }

        $tim = DB::table('tb_tim')->join('tb_bidang_tim', 'tb_bidang_tim.id_bidang_tim', '=', 'tb_tim.id_bidang_tim')->get();

        foreach ($tim as $key => $value) {
            $user = DB::table('users')->where('id_tim', $value->id_tim)->first();
            $data['tim'][] = [
                'id_tim' => $value->id_tim,
                'id_bidang_tim' => $value->id_bidang_tim,
                'aktor' => $value->nama_tim,
                'nama_tim' => $value->nama_tim,
                'jenis_kelamin_tim' => $value->jenis_kelamin_tim,
                'alamat_tim' => $value->alamat_tim,
                'nomor_hp_tim' => $value->nomor_hp_tim,
                'status_tim' => $value->status_tim,
                'nama_bidang_tim' => $value->nama_bidang_tim,
                'deskripsi_bidang_tim' => $value->deskripsi_bidang_tim,
                'file_gambar_tim' => $value->file_gambar_tim,
                'email' => $user->email,
                'level_user' => $user->level_user,
                'status_user' => $user->status_user,
            ];
        }



        return view('pages.dashboard.tim.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses tambah tim');
        }

        $data['bidang'] = DB::table('tb_bidang_tim')->orderBy('nama_bidang_tim', 'asc')->get();

        return view('pages.dashboard.tim.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
