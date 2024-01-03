<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KontenTentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses konten tentang');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $dataTentang = DB::table('tb_tentang')->get();
        $data['tentang'] = [];

        foreach ($dataTentang as $key => $value) {
            $textHero = DB::table('tb_gambar_tentang')->where('id_tentang', $value->id_tentang)->first();
            $idTim = DB::table('users')->where('id_user', $value->id_user)->value('id_tim');
            $tim = DB::table('tb_tim')->where('id_tim', $idTim)->first();

            $data['tentang'][] = [
                'id_tentang' => $value->id_tentang,
                'id_gambar_tentang' => $textHero->id_gambar_tentang,
                'aktor' => $tim->nama_tim,
                'judul_tentang' => $textHero->judul_tentang,
                'deskripsi_judul_tentang' => $textHero->deskripsi_judul_tentang,
                'deskripsi_tentang' => $textHero->deskripsi_tentang,
                'file_gambar_tentang' => $value->file_gambar_tentang,
                'status_tentang' => $value->status_tentang,
            ];
        }


        return view('pages.dashboard.kontenTentang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses create konten tentang');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();


        return view('pages.dashboard.kontenTentang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'judul_tentang' => 'required',
                'deskripsi_judul_tentang' => 'required',
                'deskripsi_tentang' => 'required',
                'file_gambar_tentang' => 'required',
                'status_tentang' => 'required',
            ],
            [
                'required' => ':attribute harus diisi',

            ]
        );

        return $request->all();
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