<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class Sorting extends Controller
{
    public function show(){
        $data['title'] = 'Sorting Barang';
        $data['url'] = 'sorting';
        $h = Histori::where('id_user', auth()->user()->id)->where('status', 'received_sort')->get();
        $fw = Histori::where('id_user', auth()->user()->id)->where('status', 'forwarded')->get();
        $data['pengiriman'] = array();
        $data['forwarded'] = array();
        $n = 0;
        foreach($h as $f){
            $data['pengiriman'][$n++] = Pengiriman::find($f->id_pengiriman);;
        }
        $n = 0;
        foreach($fw as $f){
            $data['forwarded'][$n++] = Pengiriman::find($f->id_pengiriman);;
        }
        return view('barang', $data);
    }
    public function pick(Request $req){
        dd($req);
        $p = Pengiriman::where('kode_pengiriman', $req->kode)->get()->first();
        if($p == null){
            return redirect(route('sorting'))->withErrors(['sorting' => 'Kode barang tidak terdaftar!']);
        }

        $h = new Histori();
        $h->id_pengiriman = $p->id;
        $h->tanggal = now();
        $h->deskripsi = 'Diterima di Sorting Center';
        $h->status = 'received_sort';
        $h->id_user = auth()->user()->id;
        $h->id_cabang = session('kantor')->id;
        $h->save();
        
        return redirect()->route('sorting')->with('notif', 'Berhasil Mengambil barang');
    }
}
