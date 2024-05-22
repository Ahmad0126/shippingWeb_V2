<?php

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

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->name('base');

Route::get('/user', [User::class, 'show']);

Route::post('user/tambah', [User::class, 'store'])->name('tambah_user');
Route::post('user/edit', [User::class, 'update'])->name('edit_user');
Route::post('user/hapus', [User::class, 'delete'])->name('delete_user');
