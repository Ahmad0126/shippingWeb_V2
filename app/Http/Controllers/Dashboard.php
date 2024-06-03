<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function show(){
        $data = [
            'title' => 'Dashboard',
            'users' => User::all()->count(),
            'cabang' => Cabang::all()->count(),
            'pengiriman' => Pengiriman::all()->count(),
            'worth' => Pengiriman::all()->sum('ongkir')
        ];
        return view('dashboard', $data);
    }
}
