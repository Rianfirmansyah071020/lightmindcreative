<?php

namespace App\Http\Controllers;

use App\Models\Aktifitas;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\MailSend;
use App\Models\BidangTim;
use Illuminate\Support\Facades\Mail;
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

        $tim = DB::table('tb_tim')->get();

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();


        foreach ($tim as $key => $value) {
            $user = DB::table('users')->where('id_tim', $value->id_tim)->first();
            $aktor = DB::table('tb_tim')->where('id_user', $value->id_user)->first();
            $timById = DB::table('tb_tim')->where('id_user', $value->id_user)->first();
            $bidang = DB::table('tb_bidang_tim')->where('id_bidang_tim', $value->id_bidang_tim)->first();

            $data['tim'][] = [
                'id_tim' => $value->id_tim,
                'id_bidang_tim' => $value->id_bidang_tim,
                'id_user' => $user->id_user,
                'aktor' => $aktor->nama_tim,
                'nama_tim' => $value->nama_tim,
                'jenis_kelamin_tim' => $value->jenis_kelamin_tim,
                'alamat_tim' => $value->alamat_tim,
                'nomor_hp_tim' => $value->nomor_hp_tim,
                'status_tim' => $value->status_tim,
                'nama_bidang_tim' => $bidang->nama_bidang_tim,
                'deskripsi_bidang_tim' => $bidang->deskripsi_bidang_tim,
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

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $data['bidang'] = DB::table('tb_bidang_tim')->orderBy('nama_bidang_tim', 'asc')->get();

        return view('pages.dashboard.tim.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('tambah tim');
        }


        if (DB::table('users')->where('email', $request->input('email'))->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Opps!',
                'text' => 'Email yang anda masukan sudah terdaftar'
            ]);

            $data['old'] = $request->all();

            return redirect()->back()->withInput($data['old']);
        }


        if ($request->file('file_gambar_tim') == null) {
            $file_gambar_tim = 'images/tim/default.png';
        } else {
            $nama_file = $request->file('file_gambar_tim')->getClientOriginalName();
            $file = $request->file('file_gambar_tim')->move('images/tim', $nama_file);
            $file = 'images/tim/' . $nama_file;
        }

        $dataBidang = BidangTim::where('id_bidang_tim', $request->input('id_bidang_tim'))->first();

        $data = [
            'id_tim' => Tim::GenerateID(),
            'id_bidang_tim' => $request->input('id_bidang_tim'),
            'id_user' => Session::get('id_user'),
            'nama_tim' => $request->input('nama_tim'),
            'jenis_kelamin_tim' => $request->input('jenis_kelamin_tim'),
            'alamat_tim' => $request->input('alamat_tim'),
            'nomor_hp_tim' => $request->input('nomor_hp_tim'),
            'status_tim' => $request->input('status_tim'),
            'nama_bidang_tim' => $dataBidang->nama_bidang_tim,
            'deskripsi_bidang_tim' => $dataBidang->deskripsi_bidang_tim,
            'file' => $file,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'password_ori' => $request->input('password'),
            'level_user' => $request->input('level_user'),
            'status_user' => $request->input('status_user'),
        ];

        if (Tim::CreateTim($data) && Mail::to($request->email)->send(new MailSend($data))) {


            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Tim berhasil ditambahkan'
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Tim gagal ditambahkan'
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
    public function edit(string $id, $id_user)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('akses tambah tim');
        }

        $data['bidang'] = DB::table('tb_bidang_tim')->orderBy('nama_bidang_tim', 'asc')->get();

        $data['timById'] = DB::table('tb_tim')->where('id_tim', Session::get('id_tim'))->first();
        $data['akunById'] = DB::table('users')->where('id_user', Session::get('id_user'))->first();
        $data['dataTim'] = DB::table('tb_tim')->where('id_tim', $id)->first();
        $data['dataUser'] = DB::table('users')->where('id_user', $id_user)->first();

        return view('pages.dashboard.tim.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, $id_user)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('update tim');
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
            'id_tim' => Tim::GenerateID(),
            'id_bidang_tim' => $request->input('id_bidang_tim'),
            'id_user' => Session::get('id_user'),
            'nama_tim' => $request->input('nama_tim'),
            'jenis_kelamin_tim' => $request->input('jenis_kelamin_tim'),
            'alamat_tim' => $request->input('alamat_tim'),
            'nomor_hp_tim' => $request->input('nomor_hp_tim'),
            'status_tim' => $request->input('status_tim'),
            'file' => $file,
            'email' => $request->input('email'),
            'password' => $password,
            'level_user' => $request->input('level_user'),
            'status_user' => $request->input('status_user'),
        ];

        if (Tim::UpdateTim($data, $id, $id_user)) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Tim berhasil diperbarui'
            ]);
            return redirect()->route('tim');
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Tim gagal diperbarui'
            ]);
            return redirect()->route('tim');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $id_user)
    {

        if (Session::get('id_user') == null) {
            return redirect('/login');
        } else {
            Aktifitas::CreateAktifitas('hapus tim');
        }

        $user = DB::table('users')->where('id_user', $id_user)->first();

        if (DB::table('tb_bidang_tim')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('users')->where('kode_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_Card_pelayanan')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_card_proyek')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_gambar_hero')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_gambar_tentang')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_kontak')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_pelayanan')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_proyek')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_sosial_media_tim')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_teks_hero')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_tentang')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        } else if (DB::table('tb_tim')->where('id_user', $user->id_user)->exists()) {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Anda tidak dapat menghapus data ini karena data ini terhubung dengan data lain'
            ]);
            return redirect()->back();
        }


        if (Tim::DeleteTim($id, $id_user)) {
            Session::flash('alert', [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'data tim berhasil di hapus',
            ]);
            return redirect()->back();
        } else {
            Session::flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'data tim gagal di hapus',
            ]);
            return redirect()->back();
        }
    }
}
