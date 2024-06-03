<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan as ModelLayanan;

class Layanan extends Controller
{
    public function show(){
        $data['title'] = 'Daftar Layanan';
        $data['layanan'] = ModelLayanan::orderBy('id', 'desc')->get();
        return view('layanan', $data);
    }

    public function store(Request $req){
        $req->validate([
            'nama_layanan' => 'required|max:20',
            'kapasitas' => 'required|integer|max_digits:11',
            'ongkir' => 'required|integer|max_digits:11',
            'waktu' => 'required|max:11'
        ]);

        $waktu = explode('-', $req->waktu);
        if(count($waktu) == 1){
            return redirect()->route('layanan')->withErrors(['custom_error' => 'Perkiraan Waktu harus valid misal: 1-2 hari'])->withInput();
        }
        if(!is_numeric($waktu[1]) || $waktu[0] >= $waktu[1]){
            return redirect()->route('layanan')->withErrors(['custom_error' => 'Perkiraan Waktu harus valid misal: 1-2 hari'])->withInput();
        }

        $layanan = new ModelLayanan();
        $layanan->nama_layanan = $req->nama_layanan;
        $layanan->kapasitas = $req->kapasitas;
        $layanan->waktu = $req->waktu;
        $layanan->ongkir = $req->ongkir;

        $layanan->save();

        return redirect()->route('layanan')->with('notif', 'Berhasil menambahkan layanan');
    }

    public function update(Request $req){
        $req->validate([
            'nama_layanan' => 'required|max:20',
            'kapasitas' => 'required|integer|max_digits:11',
            'ongkir' => 'required|integer|max_digits:11',
            'waktu' => 'required|max:11'
        ]);

        $waktu = explode('-', $req->waktu);
        if(count($waktu) == 1){
            return redirect()->route('layanan')->withErrors(['custom_error' => 'Perkiraan Waktu harus valid misal: 1-2 hari']);
        }
        if(!is_numeric($waktu[1]) || $waktu[0] >= $waktu[1]){
            return redirect()->route('layanan')->withErrors(['custom_error' => 'Perkiraan Waktu harus valid misal: 1-2 hari']);
        }

        $layanan = ModelLayanan::find($req->id_layanan);
        $layanan->nama_layanan = $req->nama_layanan;
        $layanan->kapasitas = $req->kapasitas;
        $layanan->waktu = $req->waktu;
        $layanan->ongkir = $req->ongkir;

        $layanan->save();

        return redirect()->route('layanan')->with('notif', 'Berhasil Mengedit layanan');
    }
    
    public function delete(Request $req){
        ModelLayanan::destroy($req->id_layanan);
        return redirect()->route('layanan')->with('notif', 'Berhasil menghapus layanan');
    }
}
