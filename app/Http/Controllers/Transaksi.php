<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function show(){
        $data['title'] = 'Daftar Transaksi';
        $data['transaksi'] = Nota::orderBy('id', 'desc')->get();
        return view('transaksi', $data);
    }
    public function detail(Request $req){
        if($req->p == null){
            abort(404);
        }
        $data['title'] = 'Detail Transaksi';
        $data['nota'] = Nota::where('no_nota', $req->p)->get()->first();
        return view('pengiriman_nota', $data);
    }
}
