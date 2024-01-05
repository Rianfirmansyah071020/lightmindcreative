<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\GambarTentang;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KontenPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses konten pelayanan');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $dataPelayanan = DB::table('tb_pelayanan')->get();

        $data['pelayanan'] = [];

        foreach ($dataPelayanan as $key => $value) {
            $cardPelayanan = DB::table('tb_card_pelayanan')->where('id_pelayanan', $value->id_pelayanan)->first();
            $idTim = DB::table('users')->where('id_user', $value->id_user)->value('id_tim');
            $tim = DB::table('tb_tim')->where('id_tim', $idTim)->first();

            $data['pelayanan'][] = [
                'id_pelayanan' => $value->id_pelayanan,
                'id_card_pelayanan' => $cardPelayanan->id_card_pelayanan,
                'aktor' => $tim->nama_tim,
                'judul_pelayanan' => $value->judul_pelayanan,
                'deskripsi_judul_pelayanan' => $value->deskripsi_judul_pelayanan,
                'deskripsi_pelayanan' => $value->deskripsi_pelayanan,
                'file_gambar_card_pelayanan' => $cardPelayanan->file_gambar_card_pelayanan,
                'status_pelayanan' => $value->status_pelayanan,
                'judul_card_pelayanan' => $cardPelayanan->judul_card_pelayanan,
                'deskripsi_judul_card_pelayanan' => $cardPelayanan->deskripsi_judul_card_pelayanan,
                'deskripsi_card_pelayanan' => $cardPelayanan->deskripsi_card_pelayanan,
            ];
        }

        $data['cardPelayanan'] = DB::table('tb_card_pelayanan')->get();


        return view('pages.dashboard.kontenPelayanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses create konten pelayanan');
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
                'judul_pelayanan' => 'required',
                'deskripsi_judul_pelayanan' => 'required',
                'deskripsi_pelayanan' => 'required',
                'file_gambar_pelayanan' => 'required',
                'status_pelayanan' => 'required',
            ],
            [
                'required' => ':attribute harus diisi',

            ]
        );

        $idTentang = Tentang::GenerateID();

        $createTentang = Tentang::create([
            'id_pelayanan' => $idTentang,
            'id_user' => Session::get('id_user'),
            'judul_pelayanan' => $validasi['judul_pelayanan'],
            'deskripsi_judul_pelayanan' => $validasi['deskripsi_judul_pelayanan'],
            'deskripsi_pelayanan' => $validasi['deskripsi_pelayanan'],
            'status_pelayanan' => $validasi['status_pelayanan'],
        ]);

        foreach ($request->file('file_gambar_pelayanan') as $key => $value) {

            $file = $request->file('file_gambar_pelayanan')[$key];
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/pelayanan'), $filename);

            $filename = 'images/tentang/' . $filename;

            $createGambarTentang = GambarTentang::create([
                'id_gambar_pelayanan' => GambarTentang::GenerateID(),
                'id_user' => Session::get('id_user'),
                'id_pelayanan' => $idTentang,
                'file_gambar_pelayanan' => $filename,
            ]);
        }


        if ($createTentang && $createGambarTentang) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten tentang berhasil ditambahkan',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal ditambahkan',
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
    public function edit(string $id, $id_gambar)
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('edit konten pelayanan');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();


        $data['pelayanan'] = DB::table('tb_pelayanan')->where('id_pelayanan', $id)->first();
        $data['gambar_pelayanan'] = DB::table('tb_gambar_pelayanan')->where('id_gambar_pelayanan', $id_gambar)->first();
        $data['gambar_tentang_all'] = DB::table('tb_gambar_pelayanan')->where('id_pelayanan', $id)->get();

        return view('pages.dashboard.kontenTentang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'judul_pelayanan' => 'required',
            'deskripsi_judul_pelayanan' => 'required',
            'deskripsi_pelayanan' => 'required',
            'status_pelayanan' => 'required',
        ]);

        $updateTentang = Tentang::where('id_pelayanan', $id)->update([
            'id_user' => Session::get('id_user'),
            'judul_pelayanan' => $validasi['judul_pelayanan'],
            'deskripsi_judul_pelayanan' => $validasi['deskripsi_judul_pelayanan'],
            'deskripsi_pelayanan' => $validasi['deskripsi_pelayanan'],
            'status_pelayanan' => $validasi['status_pelayanan'],
        ]);

        $updateGambarTentang = [];

        if ($request->hasFile('file_gambar_pelayanan')) {
            foreach ($request->file('file_gambar_pelayanan') as $key => $file) {
                // Generate a unique filename for each image
                $filename = 'images/tentang/' . $file->getClientOriginalName();

                // Move the file to the public path
                $file->move(public_path('images/pelayanan'), $filename);

                // Update the database with the new file path
                $updateGambarTentang[] = GambarTentang::where('id_gambar_pelayanan', $request->input('id_gambar_pelayanan')[$key])
                    ->where('id_pelayanan', $id)
                    ->update([
                        'id_user' => Session::get('id_user'),
                        'file_gambar_pelayanan' => $filename,
                    ]);
            }
        }

        if ($updateTentang || count($updateGambarTentang) > 0) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten tentang berhasil diupdate',
            ]);
            return redirect()->route('pelayanan');
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal diupdate',
            ]);
            return redirect()->route('pelayanan');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $id_gambar)
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('delete konten pelayanan');
        }

        if (DB::table('tb_pelayanan')->where('id_pelayanan', $id)->where('status_pelayanan', '1')->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal di hapus karena  sedang aktif',
            ]);
            return redirect()->back();
        }


        if (DB::table('tb_pelayanan')->where('id_pelayanan', $id)->delete() && DB::table('tb_gambar_pelayanan')->where('id_gambar_pelayanan', $id_gambar)->delete()) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten tentang berhasil di hapus',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal di hapus',
            ]);
            return redirect()->back();
        }
    }
}