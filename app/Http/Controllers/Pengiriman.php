<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Models\DetailPengiriman;
use App\Models\Nota;
use Illuminate\Support\Facades\Gate;
use App\Models\Pengiriman as ModelPengiriman;
use Barryvdh\DomPDF\Facade\Pdf;

class Pengiriman extends Controller
{
    public function show(){
        $data['title'] = 'Daftar Pengiriman';
        $data['pengiriman'] = ModelPengiriman::orderBy('id', 'desc')->get();
        return view('pengiriman', $data);
    }
    public function detail(Request $req){
        if($req->p == null){
            abort(404);
        }
        $data['title'] = 'Detail Pengiriman';
        $data['pengiriman'] = ModelPengiriman::where('kode_pengiriman', $req->p)->get()->first();
        return view('pengiriman_detail', $data);
    }
    public function cetaknota(Request $req){
        if($req->p == null){
            abort(404);
        }
        $data['pengiriman'] = ModelPengiriman::where('kode_pengiriman', $req->p)->get()->first();
        $pdf = Pdf::loadView('cetak_nota', $data);
        return $pdf->stream();
    }
    public function daftar(){
        if(!Gate::allows('kantor', 'Office')){
            return redirect(route('base'))->withErrors(['err_kantor' => 'Masuk ke kantor Office dahulu!']);
        }
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

        $pos1 = $req->kode_pos;
        $pos2 = session('kantor')->kode_pos;
        $diff_pos = str_pad(abs($pos1 - $pos2), 5, STR_PAD_LEFT);
        $jarak = intval(substr($diff_pos, 0, 1));

        $layanan = Layanan::find($req->id_layanan)->first();
        if($req->berat / 1000 > $layanan->kapasitas){
            return redirect()->route('pengiriman_daftar')->withErrors(
                ['pengiriman', 'Barang melebihi kapasitas layanan']
            )->withInput();
        }
        $waktu = explode('-', $layanan->waktu);
        $estimasi = $waktu[0];
        $ongkir = $layanan->ongkir;
        if($jarak > 1){ 
            $ongkir = $ongkir * $jarak * ceil($req->berat / 1000);
            $estimasi = $waktu[1]; 
        }

        $pengiriman = new ModelPengiriman();
        $pengiriman->id_layanan = $req->id_layanan;
        $pengiriman->kode_pos = $req->kode_pos;
        $pengiriman->alamat_tujuan = implode('; ', $req->alamat_tujuan);
        $pengiriman->kode_pengiriman = fake()->ean13();
        $pengiriman->ongkir = $ongkir;
        $pengiriman->estimasi = $estimasi;
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
        $histori->id_cabang = session('kantor')->id;
        $histori->save();

        if($req->process == 'true'){
            return redirect('pengiriman/checkout?kode_pengiriman%5B%5D='.$pengiriman->kode_pengiriman);
        }

        return redirect()->route('pengiriman_daftar')->with('notif', 'Berhasil menambahkan pengiriman');
    }
    public function checkout(Request $req){
        if(!Gate::allows('kantor', 'Office')){
            return redirect(route('base'))->withErrors(['err_kantor' => 'Masuk ke kantor Office dahulu!']);
        }
        if($req->kode_pengiriman == null){
            abort(404);
        }
        $data['pengiriman'] = array();
		$total = 0;
		foreach ($req->kode_pengiriman as $k) {
			$p = ModelPengiriman::where('kode_pengiriman', $k)->get()->first();
			if($p == null){
                return redirect(route('pengiriman'))->withErrors(['err_pengiriman' => 'Pengiriman tidak terdaftar!']);
			}
			if($p->histori->last()->status != 'registered'){
                return redirect(route('pengiriman'))->withErrors(['err_pengiriman' => 'Pengiriman sudah di-checkout!']);
			}
			$total += $p->ongkir;
			array_push($data['pengiriman'], $p);
		}
		$data['total'] = $total;
		$data['title'] = 'Checkout Pengiriman';
		return view('pengiriman_checkout', $data);
    }
    public function proses(Request $req){
        $req->validate([
            'id_pengiriman' => 'required',
            'pembayaran' => 'required',
            'nama_penerima' => 'required|max:60',
            'kode_pos' => 'required|numeric|max_digits:5',
            'total' => 'required|integer',
            'alamat_tujuan' => 'required',
            'no_hp_penerima' => 'nullable|numeric|max_digits:15'
        ]);

        $addr = $req->alamat_tujuan;
        $kode = $this->generate_invoice($addr, $req->kode_pos);
        $tanggal = date('Y-m-d H:i:s');
        $alamat = $addr[0].'; '.$addr[1].'; '.$addr[2];
        
        $nota = new Nota();
        $nota->no_nota = $kode;
        $nota->alamat_pengirim = $alamat;
        $nota->total = $req->total;
        $nota->nama_pengirim = $req->nama_penerima;
        $nota->no_hp_pengirim = $req->no_hp_penerima;
        $nota->pembayaran = $req->pembayaran;
        $nota->save();

        foreach ($req->id_pengiriman as $k) {
            $p = ModelPengiriman::find($k);
            $p->id_nota = $nota->id;
            $p->save();

            $h = new Histori();
            $h->id_pengiriman= $k;
            $h->tanggal= $tanggal;
            $h->deskripsi= 'Diproses di kantor';
            $h->status= 'checkout';
            $h->id_user= auth()->user()->id;
            $h->id_cabang= session('kantor')->id;
            $h->save();
        }
        return redirect()->route('pengiriman')->with('notif', 'Checkout pengiriman berhasil');
    }
    private function generate_invoice($alamat, $pos){
        $tanggal = date('ymd');
        $kota = substr(strtoupper($alamat[1]), 0, 3);
        $code = $kota.$pos.'-'.$tanggal.fake()->randomNumber(3, true);
        return $code;
    }
}
