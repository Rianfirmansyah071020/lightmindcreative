<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\GambarHero;
use App\Models\TeksHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KontenHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses konten hero');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $dataHero = DB::table('tb_gambar_hero')->get();
        $data['hero'] = [];

        foreach ($dataHero as $key => $value) {
            $textHero = DB::table('tb_teks_hero')->where('id_gambar_hero', $value->id_gambar_hero)->first();
            $idTim = DB::table('users')->where('id_user', $value->id_user)->value('id_tim');
            $tim = DB::table('tb_tim')->where('id_tim', $idTim)->first();

            $data['hero'][] = [
                'id_gambar_hero' => $value->id_gambar_hero,
                'id_teks_hero' => $textHero->id_teks_hero,
                'aktor' => $tim->nama_tim,
                'file_gambar_hero' => $value->file_gambar_hero,
                'status_gambar_hero' => $value->status_gambar_hero,
                'judul_teks_hero' => $textHero->judul_teks_hero,
                'deskripsi_teks_hero' => $textHero->deskripsi_teks_hero
            ];
        }


        return view('pages.dashboard.kontenHero.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses create konten hero');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();


        return view('pages.dashboard.kontenHero.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('membuat konten hero');
        }

        $validasi = $request->validate([
            'file_gambar_hero' => 'required',
            'status_gambar_hero' => 'required',
            'judul_teks_hero' => 'required',
            'deskripsi_teks_hero' => 'required'
        ], [
            'file_gambar_hero.required' => 'File gambar hero harus diisi',
            'status_gambar_hero.required' => 'Status gambar hero harus diisi',
            'judul_teks_hero.required' => 'Judul teks hero harus diisi',
            'deskripsi_teks_hero.required' => 'Deskripsi teks hero harus diisi'
        ]);

        foreach ($request->judul_teks_hero as $key => $value) {

            if ($request->file('file_gambar_hero') != null) {
                $file = $request->file('file_gambar_hero')[$key];
                $filename = $file->getClientOriginalName();

                $file->move(public_path('images/hero'), $filename);
                $filename = 'images/hero/' . $filename;
            }

            $idGambarHero = GambarHero::GenerateID();
            $gambarHero = GambarHero::create([
                'id_gambar_hero' => $idGambarHero,
                'id_user' => Session::get('id_user'),
                'file_gambar_hero' => $filename,
                'status_gambar_hero' => $request->status_gambar_hero[$key + 1]
            ]);

            $teksHero = TeksHero::create([
                'id_teks_hero' => TeksHero::GenerateID(),
                'id_gambar_hero' => $idGambarHero,
                'id_user' => Session::get('id_user'),
                'judul_teks_hero' => $request->judul_teks_hero[$key],
                'deskripsi_teks_hero' => $request->deskripsi_teks_hero[$key]
            ]);
        }


        if ($gambarHero && $teksHero) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten hero berhasil ditambahkan',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten hero gagal ditambahkan',
            ]);
            return redirect()->back();
        }
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
    public function edit(string $id, $id_teks)
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('edit konten hero');
        }

        $data['gambarHeroById'] = DB::table('tb_gambar_hero')->where('id_gambar_hero', $id)->first();
        $data['teksHeroById'] = DB::table('tb_teks_hero')->where('id_teks_hero', $id_teks)->first();

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        return view('pages.dashboard.kontenHero.edit', $data);
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
    public function destroy(string $id, $id_teks)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('delete konten hero');
        }



        if (DB::table('tb_gambar_hero')->where('id_gambar_hero', $id)->delete() && DB::table('tb_teks_hero')->where('id_teks_hero', $id_teks)->delete()) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten hero berhasil di hapus',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten hero gagal di hapus',
            ]);
            return redirect()->back();
        }
    }
}
