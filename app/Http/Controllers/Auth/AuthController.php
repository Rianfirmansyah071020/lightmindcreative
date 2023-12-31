<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($dataUser = User::where('remember_token', $request->cookie('remember_token'))->first()) {

            Session::put('id_user', $dataUser->id_user);

            return redirect('/dashboard');
        }

        return view('auth.login');
    }


    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Email harus diisi.',
                'password.required' => 'Password harus diisi.',
            ]
        );

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {

            if (auth()->user()->status_user == 1) {
                if (auth()->user()->level_user == 1) {

                    if (isset($request->remember)) {


                        $kodeRemember = rand(100000, 999999);
                        $kodeRemember = md5($kodeRemember);


                        if (User::where('id_user', auth()->user()->id_user)->update([
                            'remember_token' => $kodeRemember,
                        ])) {

                            Session::put('id_user', auth()->user()->id_user);

                            Session::flash('alert', [
                                'icon' => 'success',
                                'title' => 'Berhasil!',
                                'text' => 'Berhasil Login.'
                            ]);

                            // Contoh pengaturan cookie pada saat login
                            return redirect('/dashboard')->cookie('remember_token', $kodeRemember, time() + (86400 * 30), "/");
                        }
                    } else {

                        Session::put('id_user', auth()->user()->id_user);

                        Session::flash('alert', [
                            'icon' => 'success',
                            'title' => 'Berhasil!',
                            'text' => 'Berhasil Login.'
                        ]);

                        return redirect('/dashboard');
                    }
                } else {

                    Session::flash('alert', [
                        'icon' => 'warning',
                        'title' => 'Opss!',
                        'text' => 'Akun yang Anda masukan tidak terdaftar sebagai pengguna admin .'
                    ]);
                    return redirect('/login');
                }
            } else {
                Session::flash('alert', [
                    'icon' => 'warning',
                    'title' => 'Opps!',
                    'text' => 'Akun Anda tidak aktif silahkan hubungi admin.'
                ]);
                return redirect('/login');
            }
        } else {
            Session::flash('alert', [
                'icon' => 'warning',
                'title' => 'Opss!',
                'text' => 'Akun yang Anda masukan tidak ditemukan silahkan hubungi admin.'
            ]);
            return redirect('/login');
        }
    }



    public function logout(Request $request)
    {

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->cookie('remember_token')) {

            if (User::where('remember_token', $request->cookie('remember_token'))->update([
                'remember_token' => null,
            ])) {

                Session::flash('alert', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Berhasil Logout.'
                ]);

                return redirect('/login');
            }
        }

        Session::flash('alert', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Berhasil Logout.'
        ]);


        return redirect('/login');
    }
}
