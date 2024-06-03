<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col mb-4">
            <h1>Selamat datang, {{ auth()->user()->nama }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @error('err_kantor')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="fa fa-exclamation"></i></span>
                        <span class="alert-text">{{ $message }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @enderror
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Masuk Kantor</h4>
                        <a href="{{ route('login_kantor') }}" class="btn btn-primary">Masuk</a>
                    </div>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <h5>Kantor saat ini:</h5>
                        @if(session('kantor') != null)
                        <p>{{ session('kantor')->fasilitas.' '.session('kantor')->kota.' '.session('kantor')->kode_pos.' ('.session('kantor')->kode_cabang.')' }}</p>
                        @else
                        <p>Tidak ada</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Pengiriman</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">1000</h2>
                        <p class="text-white mb-0">Juni 2024 - Now</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Transaksi</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp 2000</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Total User</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">4565</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Cabang</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">66</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-sitemap"></i></span>
                </div>
            </div>
        </div>
    </div>
</x-layout>
