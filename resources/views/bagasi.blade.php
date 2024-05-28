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
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#pickup">Pickup</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deliver">Deliver</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="pickup" role="tabpanel">
                                <h4 class="card-title mb-3">Pickup Barang</h4>
                                <form action="{{ route('pick_barang') }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">Ambil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="deliver">
                                <h4 class="card-title mb-3">Antarkan Barang</h4>
                                <form id="dlv-form" action="{{ route('deliver_pickup') }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" id="kode_pengiriman" name="kode" class="form-control" placeholder="Masukkan Kode">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">Antarkan</button>
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
                        <h4>Bagasi</h4>
                        <span>
                            <input type="hidden" data-obj="pickup" class="edit-btn">
                            <button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
                            <button class="btn btn-success ok-btn" style="display: none;">OK</button>
                            <button class="btn btn-success ok-dlv-btn" style="display: none;">OK</button>
                            <button class="btn btn-primary dlv-btn">Antarkan</button>
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
                                @php $n=1 @endphp 
                                @foreach($pengiriman as $b)
                                    @if ($b->histori->last()->status == 'delivery')
                                    <tr>
                                        <td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="<?= $b->kode_pengiriman ?>"></td>
                                        <td><?= $n++ ?></td>
                                        <td><?= $b->kode_pengiriman ?></td>
                                        <td><?= $b->detail->deskripsi ?></td>
                                        <td><?= $b->detail->nama_penerima ?></td>
                                        <td><?= $b->alamat_tujuan ?></td>
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
        <form id="global_form" action="{{ route('pickup') }}" method="post">
            @csrf
        </form>
    </div>
</x-layout>