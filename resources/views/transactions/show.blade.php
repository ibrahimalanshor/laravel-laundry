@extends('_layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between align-items-center">
			<h6 class="font-weight-bold text-primary m-0">Transaksi</h6>
			<time>{{ $transaction->date }}</time>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4">
					<ul class="list-unstyled">
						<li class="mb-1">Pelanggan</li>	
						<li><b>{{ $transaction->customer->name }}</b></li>
						<li>Alamat: {{ $transaction->customer->address }}</li>
						<li>Telepon: {{ $transaction->customer->phone }}</li>
					</ul>
				</div>
				<div class="col-sm-4">
					<ul class="list-unstyled">
						<li><b>Nota</b>: {{ $transaction->note }}</li>
						<li><b>Tanggal</b>: {{ $transaction->date }}</li>
						<li><b>Status Pembayaran</b>: {!! $transaction->paymentStatusBadge !!}</li>
						<li><b>Status Pengerjaan</b>: {!! $transaction->workingStatusBadge !!}</li>
					</ul>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Paket</th>
							<th>Harga</th>
							<th>Berat</th>
							<th>Subtotal</th>
							<th>Estimasi Selesai</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $transaction->packet->name }}</td>
							<td>{{ $transaction->packet->price }}</td>
							<td>{{ $transaction->weight }}</td>
							<td>{{ $transaction->weight * $transaction->packet->price }}</td>
							<td>{{ $transaction->finishDate }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-4">
					<p class="lead">Pembayaran</p>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<th>Diskon</th>
									<td>{{ $transaction->discount }}</td>
								</tr>
								<tr>
									<th>Tax</th>
									<td>{{ $transaction->tax }}</td>
								</tr>
								<tr>
									<th>Total</th>
									<td>{{ $transaction->totalFormatted }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<a href="{{ route('transactions.print', $transaction->id) }}" class="btn btn-primary">Print</a>
			<a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
		</div>
	</div>

@endsection