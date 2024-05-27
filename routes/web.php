<?php

use App\Http\Controllers\Cabang;
use App\Http\Controllers\Layanan;
use App\Http\Controllers\Logins;
use App\Http\Controllers\Pengiriman;
use App\Http\Controllers\User;
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

Route::middleware(['auth'])->group(function (){
    Route::get('/', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('base');
    
    Route::get('/user', [User::class, 'show'])->name('user');
    Route::post('user/tambah', [User::class, 'store'])->name('tambah_user');
    Route::post('user/edit', [User::class, 'update'])->name('edit_user');
    Route::post('user/hapus', [User::class, 'delete'])->name('delete_user');
    Route::post('user/reset', [User::class, 'reset']);
    
    Route::get('/cabang', [Cabang::class, 'show'])->name('cabang');
    Route::post('cabang/tambah', [Cabang::class, 'store'])->name('tambah_cabang');
    Route::post('cabang/edit', [Cabang::class, 'update'])->name('edit_cabang');
    Route::post('cabang/hapus', [Cabang::class, 'delete'])->name('delete_cabang');
    
    Route::get('/layanan', [Layanan::class, 'show'])->name('layanan');
    Route::post('layanan/tambah', [Layanan::class, 'store'])->name('tambah_layanan');
    Route::post('layanan/edit', [Layanan::class, 'update'])->name('edit_layanan');
    Route::post('layanan/hapus', [Layanan::class, 'delete'])->name('delete_layanan');
    
    Route::get('/pengiriman', [Pengiriman::class, 'show'])->name('pengiriman');
    Route::get('/pengiriman/daftar', [Pengiriman::class, 'daftar'])->name('pengiriman_daftar');
    Route::get('/pengiriman/detail', [Pengiriman::class, 'detail'])->name('pengiriman_detail');
    Route::post('pengiriman/tambah', [Pengiriman::class, 'store'])->name('tambah_pengiriman');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [Logins::class, 'login_index'])->name('login');
    Route::post('/login', [Logins::class, 'auth_user'])->name('login_user');
});
Route::post('/logout', [Logins::class, 'logout'])->name('logout');