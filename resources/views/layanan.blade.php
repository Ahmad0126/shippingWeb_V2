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
                        <h4>Daftar Layanan</h4>
                        @can('admin')
                        <span>
                            <button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
                            <button class="btn btn-success ok-btn" style="display: none;">OK</button>
                            <div class="btn-group">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".modal-tambah">Tambah</button>
                                <button type="button" class="btn btn-primary tambah-btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"></button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <a class="dropdown-item edit-btn c-pointer" style="font-size: 0.875rem;" data-obj="layanan">
                                        <i class="fa fa-pencil text-primary m-r-5"></i>
                                        Edit Layanan
                                    </a> 
                                    <a class="dropdown-item hapus-btn c-pointer" style="font-size: 0.875rem;">
                                        <i class="fa fa-trash text-danger m-r-5"></i>
                                        Hapus Layanan
                                    </a>
                                </div>
                            </div>
                        </span>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="head">
                                    <th class="pilihan" style="display: none;">Pilih</th>
                                    <th>#</th>
                                    <th>Nama Layanan</th>
                                    <th>Kapasitas</th>
                                    <th>Waktu</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $n=1; @endphp 
                            @foreach($layanan as $l)
                                <tr>
                                    <td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="{{ $l['id'] }}"></td>
                                    <td>{{ $n++ }}</td>
                                    <td class="nama">{{ $l['nama_layanan'] }}</td>
                                    <td class="kapasitas" data-kapasitas="{{ $l['kapasitas'] }}">{{ $l['kapasitas'] }} Kg</td>
                                    <td class="waktu" data-waktu="{{ $l['waktu'] }}">{{ $l['waktu'] }} Hari</td>
                                    <td class="ongkir" data-ongkir="{{ $l['ongkir'] }}">Rp {{ number_format($l['ongkir']) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-tambah" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form action="{{ route('tambah_layanan') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Layanan</label>
                                <div class="col-sm-10">
                                    <input name="nama_layanan" type="text" class="form-control" placeholder="Masukkan Nama Layanan" value="{{ old('nama_layanan') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kapasitas</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input name="kapasitas" type="number" class="form-control" placeholder="Masukkan Kapasitas" value="{{ old('kapasitas') }}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Perkiraan Waktu</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input name="waktu" type="text" class="form-control" placeholder="3-5" value="{{ old('waktu') }}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Hari</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Biaya</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input name="ongkir" type="number" class="form-control" placeholder="Masukkan Biaya" value="{{ old('ongkir') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form action="{{ route('edit_layanan') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="basic-form">
                            <input name="id_layanan" id="id" type="hidden">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Layanan</label>
                                <div class="col-sm-10">
                                    <input name="nama_layanan" id="nama" type="text" class="form-control" placeholder="Masukkan Nama Layanan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kapasitas</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input name="kapasitas" id="kapasitas" type="number" class="form-control" placeholder="Masukkan Kapasitas">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Perkiraan Waktu</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input name="waktu" id="waktu" type="text" class="form-control" placeholder="3-5">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Hari</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Biaya</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input name="ongkir" id="ongkir" type="number" class="form-control" placeholder="Masukkan Biaya">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <div class="d-none">
        <form id="global_form" action="{{ route('delete_layanan') }}" method="post">
            @csrf
        </form>
    </div>
</x-layout>
