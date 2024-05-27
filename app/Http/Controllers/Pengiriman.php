<?php

namespace App\Http\Controllers;

use App\Models\DetailPengiriman;
use App\Models\Histori;
use App\Models\Layanan;
use Illuminate\Support\Str;
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
    public function daftar(){
        $data['title'] = 'Pendaftaran Pengiriman';
        $data['layanan'] = Layanan::all();
        return view('pengiriman_daftar', $data);
    }

    public function store(Request $req){
        $req->validate([
            'id_layanan' => 'required',
            'nama_penerima' => 'required|max:60',
            'kode_pos' => 'required|numeric|max_digits:5',
            'desc' => 'required|max:200',
            'berat' => 'required|integer',
            'koli' => 'required|integer',
            'alamat_tujuan' => 'required',
            'no_hp_penerima' => 'nullable|numeric|max_digits:15',
            'instruksi_khusus' => 'nullable|max:200'
        ]);

        $pengiriman = new ModelPengiriman();
        $pengiriman->id_layanan = $req->id_layanan;
        $pengiriman->kode_pos = $req->kode_pos;
        $pengiriman->alamat_tujuan = implode('; ', $req->alamat_tujuan);
        $pengiriman->kode_pengiriman = fake()->ean13();
        $pengiriman->ongkir = 0;
        $pengiriman->estimasi = '2';
        $pengiriman->save();

        $detail = new DetailPengiriman();
        $detail->nama_penerima = $req->nama_penerima;
        $detail->tanggal_dikirim = now();
        $detail->no_hp_penerima = $req->no_hp_penerima;
        $detail->deskripsi = $req->desc;
        $detail->berat = $req->berat;
        $detail->koli = $req->koli;
        $detail->instruksi_khusus = $req->instruksi_khusus;
        $detail->id_pengiriman = $pengiriman->id;
        $detail->save();

        $histori = new Histori();
        $histori->id_pengiriman = $pengiriman->id;
        $histori->tanggal = now();
        $histori->deskripsi = 'Telah terdaftar di kantor';
        $histori->status = 'registered';
        $histori->id_user = auth()->user()->id;
        $histori->id_cabang = 1;
        $histori->save();

        return redirect()->route('pengiriman_daftar')->with('notif', 'Berhasil menambahkan pengiriman');
    }
}
