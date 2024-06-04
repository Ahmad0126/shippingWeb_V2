<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                    <span>
                        No Nota <strong>{{ $nota->no_nota }}</strong>
                    </span>
                    <span>
                        @php 
                            $t = substr($nota->no_nota, 9, 6); 
                            $tanggal =  date('d-m-Y',strtotime($t));
                        @endphp
                        <strong>Tanggal:</strong> {{ $tanggal }}
                    </span>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="mb-3">Pengirim:</h6>
                            @if($nota->nama_pengirim != null)
                                <div>
                                    <strong>{{$nota->nama_pengirim }}</strong>
                                </div>
                                <div>{{ $nota->alamat_pengirim }}</div>
                                <div>{{ substr($nota->no_nota, 3, 5) }}</div>
                                <div>No HP: <?= $nota->no_hp_pengirim ?></div>
                            @endif
                        </div>
                    </div>
                    <h4 class="card-title">Daftar Pengiriman</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Deskripsi Barang</th>
                                    <th class="border-top-0">Berat</th>
                                    <th class="border-top-0">Layanan</th>
                                    <th class="border-top-0">Nama Penerima</th>
                                    <th class="border-top-0">Biaya</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nota->pengiriman as $p)
                                <tr>
                                    <td>{{ $p->detail->deskripsi }}</td>
                                    <td>{{ $p->detail->berat }} gram</td>
                                    <td>{{ $p->layanan->nama_layanan }}</td>
                                    <td>{{ $p->detail->nama_penerima }}</td>
                                    <td>Rp {{ number_format($p->ongkir) }}</td>
                                    <td>
                                        <a href="{{ route('pengiriman_detail').'?p='.$p->kode_pengiriman }}" class="btn btn-sm btn-primary">Detail</a>
                                        <a href="{{ route('pengiriman_cetaknota').'?p='.$p->kode_pengiriman }}" class="btn btn-sm btn-success" target="_blank">Cetak</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <h6>Total :</h6>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-dark"><strong>Rp {{ number_format($nota->total) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>