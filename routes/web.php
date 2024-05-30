<?php

use App\Http\Controllers\Cabang;
use App\Http\Controllers\Layanan;
use App\Http\Controllers\Logins;
use App\Http\Controllers\Pengiriman;
use App\Http\Controllers\Pickup;
use App\Http\Controllers\Sorting;
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

    Route::get('/masukkantor', [Logins::class, 'login_kantor'])->name('login_kantor');
    Route::post('/masukkantor', [Logins::class, 'auth_kantor'])->name('auth_kantor');
    
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
    Route::get('/pengiriman/checkout', [Pengiriman::class, 'checkout'])->name('pengiriman_checkout');
    Route::get('/pengiriman/nota', [Pengiriman::class, 'nota'])->name('pengiriman_nota');
    Route::post('pengiriman/tambah', [Pengiriman::class, 'store'])->name('tambah_pengiriman');
    Route::post('pengiriman/proses', [Pengiriman::class, 'proses'])->name('pengiriman_proses');
    
    Route::get('/pickup', [Pickup::class, 'show'])->name('pickup');
    Route::post('pickup/pick', [Pickup::class, 'pick'])->name('pick_barang');
    Route::post('pickup/deliver', [Pickup::class, 'deliver'])->name('deliver_pickup');
    Route::post('pickup/hapus', [Pickup::class, 'hapus'])->name('hapus_pickup');
    
    Route::get('/sorting', [Sorting::class, 'show'])->name('sorting');
    Route::post('sorting/pick', [Sorting::class, 'pick'])->name('pick_sort');
    Route::post('sorting/forward', [Sorting::class, 'forward'])->name('forward_sorting');
    Route::post('sorting/hapus', [Sorting::class, 'hapus'])->name('hapus_sorting');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [Logins::class, 'login_index'])->name('login');
    Route::post('/login', [Logins::class, 'auth_user'])->name('login_user');
});
Route::post('/logout', [Logins::class, 'logout'])->name('logout');