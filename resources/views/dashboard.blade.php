<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col">
            <h1>Dashboard</h1>
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
</x-layout>
