<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengiriman as ModelPengiriman;

class Pengiriman extends Controller
{
    public function show(){
        $data['title'] = 'Daftar Pengiriman';
        $data['pengiriman'] = ModelPengiriman::all();
        return view('pengiriman', $data);
    }
    
    public function detail(Request $req){
        $data['title'] = 'Detail Pengiriman';
        $data['pengiriman'] = ModelPengiriman::where('kode_pengiriman', $req->p)->get()[0];
        return view('pengiriman_detail', $data);
    }

    public function store(Request $req){
        $req->validate([
            'username' => 'unique:user,username|max:25|required',
            'nama' => 'required|max:60',
            'password' => 'required|min:4',
            'level' => 'required',
            'kota' => 'required|max:30',
            'telp' => 'nullable|numeric|max_digits:15'
        ]);

        $user = new ModelPengiriman();
        $user->username = $req->username;
        $user->nama = $req->nama;
        $user->password = Hash::make($req->password);
        $user->level = $req->level;
        $user->kota = $req->kota;
        $user->telp = $req->telp;

        $user->save();

        return redirect()->route('user')->with('notif', 'Berhasil menambahkan user');
    }
}
