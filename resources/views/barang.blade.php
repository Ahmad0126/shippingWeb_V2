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
                    <div class="default-tab">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#acc">Terima</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fwd">Teruskan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="acc" role="tabpanel">
                                <h4 class="card-title mb-3">Terima Barang</h4>
                                <div class="tab-pane fade active show" id="kode" role="tabpanel">
                                    <form action="{{ route('base').'/'.$url.'/pick' }}" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <div class="input-group">
                                                    <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Terima</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <a href="{{ $url.'/forwarded' }}" class="btn btn-primary form-control">
                                                    Barang Yang Diteruskan
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fwd">
                                <h4 class="card-title mb-3">Teruskan Ke Kantor lain</h4>
                                <form action="{{ route('base').'/'.$url.'/forward' }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <input name="kode_cabang" type="text" class="form-control" placeholder="Masukkan Kode Kantor">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <div class="input-group">
                                                <input type="text" name="kode_pengiriman" class="form-control" placeholder="Masukkan Kode Pengiriman">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Teruskan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h4>Gudang</h4>
                        <span>
                            <input type="hidden" data-obj="{{ $url }}" class="edit-btn">
                            <button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
                            <button class="btn btn-success ok-btn" style="display: none;">OK</button>
                            <button class="btn btn-warning hapus-btn">Batalkan</button>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="pilihan" style="display: none;">Pilih</th>
                                    <th>#</th>
                                    <th>Kode Pengiriman</th>
                                    <th>Deskripsi Barang</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $n=1;
                                    switch ($url) {
                                        case 'warehouse': $st = 'received_warehouse'; break;
                                        case 'gateway': $st = 'received_origin'; break;
                                        default: $st = 'received_sort'; break;
                                    }
                                @endphp
                                @foreach($pengiriman as $b)
                                    @if ($b->histori->last()->status == $st)
                                    <tr>
                                        <td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="{{ $b->kode_pengiriman }}"></td>
                                        <td>{{ $n++ }}</td>
                                        <td>{{ $b->kode_pengiriman }}</td>
                                        <td>{{ $b->detail->deskripsi }}</td>
                                        <td>{{ $b->detail->nama_penerima }}</td>
                                        <td>{{ $b->alamat_tujuan }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <form id="global_form" action="{{ route('sorting') }}" method="post">
            @csrf
        </form>
    </div>
</x-layout>