<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BidangTimController;
use App\Http\Controllers\DashboardController;
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
