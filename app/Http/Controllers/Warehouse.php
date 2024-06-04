<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Histori;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Warehouse extends Controller
{
    public function show(){
        if(!Gate::allows('kantor', 'Warehouse')){
            return redirect(route('base'))->withErrors(['err_kantor' => 'Masuk ke Warehouse dahulu!']);
        }
        $data['title'] = 'Warehouse Barang';
        $data['url'] = 'warehouse';
        $h = Histori::where('id_user', auth()->user()->id)->where('status', 'received_warehouse')->get();
        $data['pengiriman'] = array();
        $n = 0;
        foreach($h as $f){
            $data['pengiriman'][$n++] = Pengiriman::find($f->id_pengiriman);;
        }
        return view('barang', $data);
    }
    public function forwarded(){
        if(!Gate::allows('kantor', 'Warehouse')){
            return redirect(route('base'))->withErrors(['err_kantor' => 'Masuk ke Warehouse dahulu!']);
        }
        $data['title'] = 'Warehouse Barang';
        $data['url'] = 'warehouse';
        $fw = Histori::where('id_user', auth()->user()->id)->where('status', 'forwarded')->get();
        $data['forwarded'] = array();
        $n = 0;
        foreach($fw as $f){
            $data['forwarded'][$n++] = Pengiriman::find($f->id_pengiriman);;
        }
        return view('forwarded', $data);
    }
    public function pick(Request $req){
        $p = Pengiriman::where('kode_pengiriman', $req->kode)->get()->first();
        if($p == null){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Kode barang tidak terdaftar!']);
        }
        if($p->histori->last()->status == 'received_warehouse'){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Barang sudah diterima!']);
        }
        if($p->histori->last()->status == 'delivered'){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Barang sudah diantar ke penerima!']);
        }

        $h = new Histori();
        $h->id_pengiriman = $p->id;
        $h->tanggal = now();
        $h->deskripsi = 'Diterima di Warehouse';
        $h->status = 'received_warehouse';
        $h->id_user = auth()->user()->id;
        $h->id_cabang = session('kantor')->id;
        $h->save();
        
        return redirect()->route('warehouse')->with('notif', 'Berhasil Mengambil barang');
    }
    public function forward(Request $req){
        $p = Pengiriman::where('kode_pengiriman', $req->kode_pengiriman)->get()->first();
        if($p == null){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Kode barang tidak terdaftar!']);
        }
        if($p->histori->last()->status == 'delivered'){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Barang sudah diantar ke penerima!']);
        }
        $h = Histori::where('id_user', auth()->user()->id)->where('status', 'received_warehouse')->where('id_pengiriman', $p->id)->get()->first();
        if($h == null){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Barang tidak ada di bagasi!']);
        }
        $c = Cabang::where('kode_cabang', $req->kode_cabang)->get()->first();
        if($c == null){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Kode kantor tidak terdaftar!']);
        }
        if($c->kode_cabang == session('kantor')->kode_cabang){
            return redirect(route('warehouse'))->withErrors(['warehouse' => 'Tidak dapat meneruskan ke kantor sendiri!']);
        }

        $h = new Histori();
        $h->id_pengiriman = $p->id;
        $h->tanggal = now();
        $h->deskripsi = 'Diteruskan ke '.$c->fasilitas;
        $h->status = 'forwarded';
        $h->id_user = auth()->user()->id;
        $h->id_cabang = $c->id;
        $h->save();
        
        return redirect()->route('warehouse')->with('notif', 'Berhasil meneruskan barang');
    }
    public function hapus(Request $req){
        foreach($req->id_user as $p){
            $pe = Pengiriman::where('kode_pengiriman', $p)->get()->first();
            $h = Histori::where('id_pengiriman', $pe->id)->where('status', 'received_warehouse')->get()->first();
            $h->delete();
        }
        return redirect()->route('warehouse')->with('notif', 'Berhasil membatalkan pickup');
    }
}
