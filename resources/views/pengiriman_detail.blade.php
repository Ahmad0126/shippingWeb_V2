<x-layout>
	<x-slot:title>{{ $title }}</x-slot:title>
	<div class="col-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<span>
					Pengiriman <strong>{{ $pengiriman->kode_pengiriman }}</strong>
				</span>
				<span>
					<strong>Status:</strong> {{ ucfirst($pengiriman->histori->last()->status) }}
				</span>
			</div>
			<hr class="m-0">
			<div class="card-body">
				<div class="row mb-4">
					<div class="col-sm-6">
						<h6 class="mb-3">Pengirim:</h6>
						@if($pengiriman->nota != null)
						<div>
							<strong>{{ $pengiriman->nota->nama_pengirim }}</strong>
						</div>
						<div>{{ $pengiriman->nota->alamat_pengirim }}</div>
						<div>{{ substr($pengiriman->nota->no_nota, 3, 5) }}</div>
						<div>No HP: {{ $pengiriman->nota->no_hp_pengirim }}</div>
						@endif
					</div>
					<div class="col-sm-6">
						<h6 class="mb-3">Penerima:</h6>
						<div>
							<strong>{{ $pengiriman->detail->nama_penerima }}</strong>
						</div>
						<div>{{ $pengiriman->alamat_tujuan }}</div>
						<div>{{ $pengiriman->kode_pos }}</div>
						<div>No HP: {{ $pengiriman->detail->no_hp_penerima }}</div>
					</div>
				</div>
				<div class="table-responsive-sm">
					<h4>Histori Status</h4>
					<table class="table table-striped">
						<thead>
							<th>#</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Kantor</th>
							<th>Deskripsi</th>
						</thead>
						@php $n=1 @endphp
						@foreach($pengiriman->histori as $h)
							<tr>
								<td class="center">{{ $n++ }}</td>
								<td class="left strong">{{ $h->tanggal }}</td>
								<td class="left">{{ ucfirst($h->status) }}</td>
								<td class="right">@if ($h->cabang != null) {{ $h->cabang->fasilitas.' '.$h->cabang->kota }} @endif</td>
								<td class="center">{{ $h->deskripsi }}</td>
							</tr>
						@endforeach
					</table>
				</div>
				<div class="row">
					<div class="col-lg-4 col-12 ms-auto">
						<table class="table table-clear">
							<tbody>
								<tr>
									<td class="left">
										<strong>Layanan</strong>
									</td>
									<td class="right">{{ $pengiriman->layanan->nama_layanan }}</td>
								</tr>
								<tr>
									<td class="left">
										<strong>Tanggal Dikirim</strong>
									</td>
									<td class="right">{{ $pengiriman->detail->tanggal_dikirim }}</td>
								</tr>
								<tr>
									<td class="left">
										<strong>Berat</strong>
									</td>
									<td class="right">{{ $pengiriman->detail->berat }} gram</td>
								</tr>
								<tr>
									<td class="left">
										<strong>Koli</strong>
									</td>
									<td class="right">
										<strong>{{ $pengiriman->detail->koli }}</strong>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-12">
						<table class="table table-clear">
							<tbody>
								<tr>
									<td class="left">
										<strong>Deskripsi:</strong>
									</td>
								</tr>
								<tr>
									<td>{{ $pengiriman->detail->deskripsi }}</td>
								</tr>
								<tr>
									<td class="left">
										<strong>Instruksi Khusus:</strong>
									</td>
								</tr>
								<tr>
									<td>{{ $pengiriman->detail->instruksi_khusus }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-12">
						<table class="table table-clear">
							<tr>
								<td><strong>Estimasi Tiba</strong></td>
								<td>{{ $pengiriman->estimasi }} hari</td>
							</tr>
							<tr>
								<td><strong>Biaya</strong></td>
								<td>Rp @if($pengiriman->nota != null) {{ number_format($pengiriman->nota->ongkir) }} @endif</td>
							</tr>
							<tr>
								<td><strong>Pembayaran</strong></td>
								<td>@if($pengiriman->nota != null) {{ $pengiriman->nota->pembayaran }} @endif</td>
							</tr>
							<tr>
								<td><strong>Nota Terkait</strong></td>
								<td>@if($pengiriman->nota != null) <a href="{{ route('pengiriman_nota') }}?p={{ $pengiriman->nota->no_nota }}"> {{ $pengiriman->nota->no_nota }} @endif</a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-layout>
