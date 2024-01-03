<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BidangTimController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontenHeroController;
use App\Http\Controllers\KontenTentangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/bidang', [BidangTimController::class, 'index'])->name('bidang');
Route::get('/bidang/create', [BidangTimController::class, 'create'])->name('bidang.create');
Route::post('/bidang', [BidangTimController::class, 'store'])->name('bidang');
Route::get('/bidang/delete/{id}', [BidangTimController::class, 'destroy'])->name('bidang.delete');
Route::get('/bidang/edit/{id}', [BidangTimController::class, 'edit'])->name('bidang.edit');
Route::put('/bidang/update/{id}', [BidangTimController::class, 'update'])->name('bidang.update');
Route::get('/tim', [TimController::class, 'index'])->name('tim');
Route::get('/tim/create', [TimController::class, 'create'])->name('tim.create');
Route::post('/tim', [TimController::class, 'store'])->name('tim');
Route::get('/tim/delete/{id}/{id_user}', [TimController::class, 'destroy'])->name('tim.delete');
Route::get('/tim/edit/{id}/{id_user}', [TimController::class, 'edit'])->name('tim.edit');
Route::put('/tim/update/{id}/{id_user}', [TimController::class, 'update'])->name('tim.update');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/setting', [ProfileController::class, 'viewSetting'])->name('setting');
Route::put('/setting/{id}/{id_user}', [ProfileController::class, 'SettingProfile'])->name('SettingProfile');

// hero
Route::get('/hero', [KontenHeroController::class, 'index'])->name('hero');
Route::get('/hero/create', [KontenHeroController::class, 'create'])->name('hero.create');
Route::post('/hero', [KontenHeroController::class, 'store'])->name('hero');
Route::get('/hero/delete/{id}/{id_teks}', [KontenHeroController::class, 'destroy'])->name('hero.delete');
Route::get('/hero/{id}/{id_teks}', [KontenHeroController::class, 'edit'])->name('hero.edit');
Route::put('/hero/update/{id}/{id_teks}', [KontenHeroController::class, 'update'])->name('hero.update');

// tentang
Route::get('/tentang', [KontenTentangController::class, 'index'])->name('tentang');
Route::get('/tentang/create', [KontenTentangController::class, 'create'])->name('tentang.create');
Route::post('/tentang', [KontenTentangController::class, 'store'])->name('tentang');
Route::get('/tentang/delete/{id}/{id_teks}', [KontenTentangController::class, 'destroy'])->name('tentang.delete');
Route::get('/tentang/{id}/{id_teks}', [KontenTentangController::class, 'edit'])->name('tentang.edit');
Route::put('/tentang/update/{id}/{id_teks}', [KontenTentangController::class, 'update'])->name('tentang.update');