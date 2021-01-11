@extends('_layouts.app')

@section('title', 'Transaksi Baru')

@section('content')

	<form action="{{ route('transactions.store') }}" method="post" class="create">
	<div class="row">
		@csrf
		<div class="col-sm-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="font-weight-bold text-primary m-0">Pelanggan</h6>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nama</label>
						<select name="customer_id" class="form-control custom-select @error('customer_id') is-invalid @enderror" name="customer_id"></select>

						@error('customer_id')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror		
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input type="text" class="form-control" name="phone" placeholder="Telepon" disabled />
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="address" placeholder="Alamat" disabled />
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="font-weight-bold text-primary m-0">Data Laundry</h6>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Paket</label>
								<select name="packet_id" class="form-control custom-select @error('packet_id') is-invalid @enderror" name="packet_id"></select>

								@error('packet_id')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror		
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Berat(Kg)</label>
								<input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" name="weight" placeholder="Berat">

								@error('weight')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror		
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Harga(*kilo)</label>
								<input type="text" class="form-control" name="price" placeholder="Harga" disabled />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Sub Total</label>
								<input type="text" class="form-control" name="subtotal" placeholder="Sub Total" disabled />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Estimasi Selesai</label>
						<input type="date" class="form-control @error('finish') is-invalid @enderror" name="finish" placeholder="Estimasi Selesai" />

						@error('finish')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="font-weight-bold text-primary m-0">Pembayaran</h6>
				</div>
				<div class="card-body">
					<div class="form-row">
						<div class="col-sm-4">
							<div class="form-group">
								<label>Diskon</label>
								<input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" placeholder="Diskon" />

								@error('discount')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>Pajak(%)</label>
								<input type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Pajak" />

								@error('tax')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>Grand Total</label>
								<input type="text" class="form-control @error('total') is-invalid @enderror" name="total" placeholder="Pajak" readonly />
							</div>

							@error('total')
								<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>Status Pembayaran</label>
								<select class="form-control custom-select @error('payment_status') is-invalid @enderror" name="payment_status">
									<option value="0">Belum Bayar</option>
									<option value="1">Sudah Bayar</option>
								</select>

								@error('payment_status')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>Status Pengerjaan</label>
								<select class="form-control custom-select @error('working_status') is-invalid @enderror" name="working_status">
									<option value="0">Belum Selesai</option>
									<option value="1">Sudah Selesai</option>
								</select>

								@error('working_status')
									<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary" type="submit">Simpan</button>
					<a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
				</div>
			</div>
		</div>
	</div>
	</form>

@endsection

@push('css')
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
	<script src="{{ asset('sbadmin/vendor/select2/js/select2.min.js') }}"></script>
	<script>
		const customerSearch = '{{ route('customers.search') }}'
		const packetSearch = '{{ route('packets.search') }}'
		const csrf = '{{ csrf_token() }}'
	</script>
	<script src="{{ asset('js/transaction-create.js') }}"></script>
@endpush