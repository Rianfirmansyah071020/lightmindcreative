<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\GambarTentang;
use App\Models\Tentang;
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
            $gambarTentang = DB::table('tb_gambar_tentang')->where('id_tentang', $value->id_tentang)->first();
            $idTim = DB::table('users')->where('id_user', $value->id_user)->value('id_tim');
            $tim = DB::table('tb_tim')->where('id_tim', $idTim)->first();

            $data['tentang'][] = [
                'id_tentang' => $value->id_tentang ?? "",
                'id_gambar_tentang' => $gambarTentang->id_gambar_tentang ?? "",
                'aktor' => $tim->nama_tim,
                'judul_tentang' => $value->judul_tentang ?? "",
                'deskripsi_judul_tentang' => $value->deskripsi_judul_tentang ?? "",
                'deskripsi_tentang' => $value->deskripsi_tentang ?? "",
                'file_gambar_tentang' => $gambarTentang->file_gambar_tentang ?? "",
                'status_tentang' => $value->status_tentang ?? "",
            ];
        }

        $data['gambarTentang'] = DB::table('tb_gambar_tentang')->get();


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

        $idTentang = Tentang::GenerateID();

        $createTentang = Tentang::create([
            'id_tentang' => $idTentang,
            'id_user' => Session::get('id_user'),
            'judul_tentang' => $validasi['judul_tentang'],
            'deskripsi_judul_tentang' => $validasi['deskripsi_judul_tentang'],
            'deskripsi_tentang' => $validasi['deskripsi_tentang'],
            'status_tentang' => $validasi['status_tentang'],
        ]);

        foreach ($request->file('file_gambar_tentang') as $key => $value) {

            $file = $request->file('file_gambar_tentang')[$key];
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/tentang'), $filename);

            $filename = 'images/tentang/' . $filename;

            $createGambarTentang = GambarTentang::create([
                'id_gambar_tentang' => GambarTentang::GenerateID(),
                'id_user' => Session::get('id_user'),
                'id_tentang' => $idTentang,
                'file_gambar_tentang' => $filename,
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
            Aktifitas::CreateAktifitas('edit konten tentang');
        }

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();


        $data['tentang'] = DB::table('tb_tentang')->where('id_tentang', $id)->first();
        $data['gambar_tentang'] = DB::table('tb_gambar_tentang')->where('id_gambar_tentang', $id_gambar)->first();
        $data['gambar_tentang_all'] = DB::table('tb_gambar_tentang')->where('id_tentang', $id)->get();

        return view('pages.dashboard.kontenTentang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'judul_tentang' => 'required',
            'deskripsi_judul_tentang' => 'required',
            'deskripsi_tentang' => 'required',
            'status_tentang' => 'required',
        ]);

        $updateTentang = Tentang::where('id_tentang', $id)->update([
            'id_user' => Session::get('id_user'),
            'judul_tentang' => $validasi['judul_tentang'],
            'deskripsi_judul_tentang' => $validasi['deskripsi_judul_tentang'],
            'deskripsi_tentang' => $validasi['deskripsi_tentang'],
            'status_tentang' => $validasi['status_tentang'],
        ]);

        $updateGambarTentang = [];

        if ($request->hasFile('file_gambar_tentang')) {
            foreach ($request->file('file_gambar_tentang') as $key => $file) {
                // Generate a unique filename for each image
                $filename = 'images/tentang/' . $file->getClientOriginalName();

                // Move the file to the public path
                $file->move(public_path('images/tentang'), $filename);

                // Update the database with the new file path
                $updateGambarTentang[] = GambarTentang::where('id_gambar_tentang', $request->input('id_gambar_tentang')[$key])
                    ->where('id_tentang', $id)
                    ->update([
                        'id_user' => Session::get('id_user'),
                        'file_gambar_tentang' => $filename,
                    ]);
            }
        }

        if ($updateTentang || count($updateGambarTentang) > 0) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data konten tentang berhasil diupdate',
            ]);
            return redirect()->route('tentang');
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal diupdate',
            ]);
            return redirect()->route('tentang');
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
            Aktifitas::CreateAktifitas('delete konten tentang');
        }

        if (DB::table('tb_tentang')->where('id_tentang', $id)->where('status_tentang', '1')->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data konten tentang gagal di hapus karena  sedang aktif',
            ]);
            return redirect()->back();
        }


        if (DB::table('tb_tentang')->where('id_tentang', $id)->delete() && DB::table('tb_gambar_tentang')->where('id_gambar_tentang', $id_gambar)->delete()) {
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