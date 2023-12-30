<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\BidangTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class BidangTimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses bidang tim');
        }

        $bidang = DB::table('tb_bidang_tim')->get();

        // return $bidang;

        foreach ($bidang as $key => $value) {
            $tim = DB::table('tb_tim')->where('id_user', $value->id_user)->first();
            $data['bidang'][] = [
                'id_bidang_tim' => $value->id_bidang_tim,
                'aktor' => $tim->nama_tim,
                'nama_bidang_tim' => $value->nama_bidang_tim,
                'deskripsi_bidang_tim' => $value->deskripsi_bidang_tim,
            ];
        }




        return view('pages.dashboard.bidang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('Tambah Data Bidang');
        }

        return view('pages.dashboard.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            // Validasi input menggunakan metode validate
            $validasi = $request->validate([
                'nama_bidang_tim' => 'required',
                'deskripsi_bidang_tim' => 'required',
            ], [
                'nama_bidang_tim.required' => 'Nama bidang harus diisi',
                'deskripsi_bidang_tim.required' => 'Deskripsi bidang harus diisi',
            ]);

            // Logika untuk menyimpan data jika validasi berhasil
            if (BidangTim::CreateBidang($request)) {
                Session::flash('alert', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'data bidang tim berhasil ditambahkan',
                ]);
                return redirect()->back();
            } else {
                Session::flash('alert', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'data bidang tim gagal ditambahkan',
                ]);
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            // Mengambil pesan error dari validasi
            $errors = $e->validator->errors();

            // Menggunakan pesan error untuk menetapkan flash session
            foreach ($errors->keys() as $key) {
                $errorMessage = $errors->first($key);

                Session::flash('alert', [
                    'icon' => 'error',
                    'title' => 'Oops!',
                    'text' => $errorMessage,
                ]);
            }

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
    public function edit(string $id)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('Edit Data Bidang');
        }



        $data['data'] = BidangTim::where('id_bidang_tim', $id)->first();

        return view('pages.dashboard.bidang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            // Validasi input menggunakan metode validate
            $validasi = $request->validate([
                'nama_bidang_tim' => 'required',
                'deskripsi_bidang_tim' => 'required',
            ], [
                'nama_bidang_tim.required' => 'Nama bidang harus diisi',
                'deskripsi_bidang_tim.required' => 'Deskripsi bidang harus diisi',
            ]);

            // Logika untuk menyimpan data jika validasi berhasil
            if (BidangTim::UpdateBidang($request, $id)) {
                Session::flash('alert', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'data bidang tim berhasil update',
                ]);
                return redirect()->route('bidang');
            } else {
                Session::flash('alert', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'data bidang tim gagal update',
                ]);
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            // Mengambil pesan error dari validasi
            $errors = $e->validator->errors();

            // Menggunakan pesan error untuk menetapkan flash session
            foreach ($errors->keys() as $key) {
                $errorMessage = $errors->first($key);

                Session::flash('alert', [
                    'icon' => 'error',
                    'title' => 'Oops!',
                    'text' => $errorMessage,
                ]);
            }

            return redirect()->route('bidang');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (BidangTim::DeleteBidang($id)) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data bidang tim berhasil di hapus',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data bidang tim gagal di hapus',
            ]);
            return redirect()->back();
        }
    }
}
