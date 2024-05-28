<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $e)
                        <p>
                            <span class="alert-icon"><i class="fa fa-exclamation"></i></span>
                            <span class="alert-text">{{ $e }}</span>
                        </p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-title d-flex justify-content-between">
                        <h4>Daftar Pengiriman</h4>
                        <span>
                            <button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
                            <button class="btn btn-success checkout-btn" style="display: none;">Checkout</button>
                            <button class="btn btn-success cck-btn">Checkout</button>
                            <a class="btn btn-primary tambah-btn" href="{{ route('pengiriman_daftar') }}">Pendaftaran</a>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="pilihan" style="display: none;">Pilih</th>
                                    <th>#</th>
                                    <th>Kode Pengiriman</th>
                                    <th>Nama Penerima</th>
                                    <th>Kota Tujuan</th>
                                    <th>Tanggal Dikirim</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="chot_pngrmn" action="{{ route('tambah_pengiriman') }}" method="get">
                                    @php $n=1 @endphp
                                    @if ($pengiriman != null)
                                    @foreach($pengiriman as $p)
                                    <tr>
                                        <td class="pilihan" style="display: none;">
                                            @if($p->status == 'registered')
                                            <input class="ids" type="checkbox" name="kode_pengiriman[]" value="{{ $p->kode_pengiriman }}">
                                            @endif
                                        </td>
                                        <td>{{ $n++ }}</td>
                                        <td>{{ $p->kode_pengiriman }}</td>
                                        <td>{{ $p->detail->nama_penerima }}</td>
                                        <td>{{ Str::limit($p->alamat_tujuan, 20) }}</td>
                                        <td>{{ $p->detail->tanggal_dikirim }}</td>
                                        <td>{{ $p->layanan->nama_layanan }}</td>
                                        <td>{{ strtoupper($p->histori->last()->status) }}</td>
                                        <td>
                                            <a href="pengiriman/detail?p={{ $p->kode_pengiriman }}">
                                                Detail<i class="fa fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
