<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class Pickup extends Controller
{
    public function show(){
        $data['title'] = 'Pickup Barang';
        $h = Histori::where('id_user', auth()->user()->id)->where('status', 'delivery')->get();
        $data['pengiriman'] = array();
        $n = 0;
        foreach($h as $f){
            $data['pengiriman'][$n++] = Pengiriman::find($f->id_pengiriman);;
        }
        return view('bagasi', $data);
    }
    public function pick(Request $req){
        $p = Pengiriman::where('kode_pengiriman', $req->kode)->get()->first();
        if($p == null){
            return redirect(route('pickup'))->withErrors(['pickup' => 'Kode barang tidak terdaftar!']);
        }

        $h = new Histori();
        $h->id_pengiriman = $p->id;
        $h->tanggal = now();
        $h->deskripsi = 'Dibawa oleh kurir';
        $h->status = 'delivery';
        $h->id_user = auth()->user()->id;
        $h->id_cabang = session('kantor') != null ? session('kantor')->id : null;
        $h->save();
        
        return redirect()->route('pickup')->with('notif', 'Berhasil Mengambil barang');
    }
    public function deliver(Request $req){
        $p = Pengiriman::where('kode_pengiriman', $req->kode)->get()->first();
        if($p == null){
            return redirect(route('pickup'))->withErrors(['pickup' => 'Kode barang tidak terdaftar!']);
        }
        $h = Histori::where('id_user', auth()->user()->id)->where('status', 'delivery')->where('id_pengiriman', $p->id)->get()->first();
        if($h == null){
            return redirect(route('pickup'))->withErrors(['pickup' => 'Barang tidak ada di bagasi!']);
        }

        $h = new Histori();
        $h->id_pengiriman = $p->id;
        $h->tanggal = now();
        $h->deskripsi = 'Diantar ke penerima';
        $h->status = 'delivered';
        $h->id_user = auth()->user()->id;
        $h->id_cabang = session('kantor') != null ? session('kantor')->id : null;
        $h->save();
        
        return redirect()->route('pickup')->with('notif', 'Berhasil mengantar barang');
    }
    public function hapus(Request $req){
        foreach($req->id_user as $p){
            $pe = Pengiriman::where('kode_pengiriman', $p)->get()->first();
            $h = Histori::where('id_pengiriman', $pe->id)->where('status', 'delivery')->get()->first();
            $h->delete();
        }
        return redirect()->route('pickup')->with('notif', 'Berhasil membatalkan pickup');
    }
}
