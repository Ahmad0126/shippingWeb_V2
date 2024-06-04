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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="slc-acc" style="display: none;">Pilih</th>
                                    <th>#</th>
                                    <th>Kode Pengiriman</th>
                                    <th>Deskripsi Barang</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1 @endphp
                                @foreach($forwarded as $f)
                                    @if ($f->histori->last()->id_cabang == session('kantor')->id && $f->histori->last()->status == 'forwarded')
                                    <tr>
                                        <td class="slc-acc" style="display: none;"><input class="kodes" type="checkbox" value="{{ $f->kode_pengiriman }}"></td>
                                        <td>{{ $n++ }}</td>
                                        <td>{{ $f->kode_pengiriman }}</td>
                                        <td>{{ $f->detail->deskripsi }}</td>
                                        <td>{{ $f->detail->nama_penerima }}</td>
                                        <td>{{ $f->alamat_tujuan }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary terima-btn" data-kode="{{ $f->kode_pengiriman }}">
                                                Terima
                                            </button>
                                        </td>
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