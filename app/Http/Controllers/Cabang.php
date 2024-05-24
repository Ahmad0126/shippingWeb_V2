<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang as ModelCabang;

class Cabang extends Controller
{
    public function show(){
        $data['title'] = 'Daftar Cabang';
        $data['cabang'] = ModelCabang::all();
        return view('cabang', $data);
    }

    public function store(Request $req){
        $req->validate([
            'fasilitas' => 'required',
            'kota' => 'required|max:30',
            'kode_pos' => 'required|numeric|max_digits:11',
            'alamat' => 'required|max:200'
        ]);

        $cabang = new ModelCabang();
        $cabang->alamat = $req->alamat;
        $cabang->fasilitas = $req->fasilitas;
        $cabang->kota = $req->kota;
        $cabang->kode_pos = $req->kode_pos;
        $cabang->kode_cabang = $this->generate_code($req->kode_pos, $req->fasilitas, $req->kota);

        $cabang->save();

        return redirect()->route('cabang')->with('notif', 'Berhasil menambahkan cabang');
    }

    public function update(Request $req){
        $req->validate([
            'fasilitas' => 'required',
            'kota' => 'required|max:30',
            'kode_pos' => 'required|numeric|max_digits:11',
            'alamat' => 'required|max:200'
        ]);
        
        $cabang = ModelCabang::find($req->id_cabang);
        if($cabang->fasilitas != $req->fasilitas || $cabang->kota != $req->kota || $cabang->kode_pos != $req->kode_pos){
            $cabang->kode_cabang = $this->generate_code($req->kode_pos, $req->fasilitas, $req->kota);
        }
        $cabang->alamat = $req->alamat;
        $cabang->fasilitas = $req->fasilitas;
        $cabang->kota = $req->kota;
        $cabang->kode_pos = $req->kode_pos;
        
        $cabang->save();

        return redirect()->route('cabang')->with('notif', 'Berhasil Mengedit cabang');
    }
    
    public function delete(Request $req){
        ModelCabang::destroy($req->id_user);
        return redirect()->route('cabang')->with('notif', 'Berhasil menghapus cabang');
    }

    private function generate_code($p, $f, $k){
        switch ($f) {
            case 'Warehouse': $fasilitas = 'WH'; break;
            case 'Sorting Center': $fasilitas = 'SC'; break;
            case 'Gateway': $fasilitas = 'GT'; break;
            default: $fasilitas = 'OF'; break;
        };

        $kota = substr(strtoupper($k), 0, 3);
        $kode_pos = $p;
        
        $hsl = ModelCabang::where('kode_cabang', "LIKE", "%".'C-'.$kota.$kode_pos."%".$fasilitas)->get()->last();
        $hsl == null ? $total = 1 :
        $total = intval(substr($hsl->kode_cabang, 11, 3)) + 1;
        $id = str_pad($total, 3, '0', STR_PAD_LEFT);

        $code = 'C-'.$kota.$kode_pos.'-'.$id.$fasilitas;
        return $code;
    }
}
