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
                        <h4>Daftar Transaksi</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Nota</th>
                                    <th>Nama Pengirim</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1 @endphp
                                @if ($transaksi != null)
                                @foreach($transaksi as $p)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $p->no_nota }}</td>
                                    <td>{{ $p->nama_pengirim }}</td>
                                    <td>{{ date('d-m-Y H:i',strtotime($p->created_at)) }}</td>
                                    <td>Rp {{ number_format($p->total) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('transaksi_detail') }}?p={{ $p->no_nota }}">
                                            Detail<i class="fa fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
