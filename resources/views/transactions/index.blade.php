@extends('_layouts.app')

@section('title', 'Data Transaksi')

@section('content')
	
	@if (session()->has('success'))
		<div class="alert alert-success alert-dismissible">
			{{ session('success') }}
			<button class="close" data-dismiss="alert">&times;</button>
		</div>
	@endif

	<div id="alert"></div>

	<div class="card shadow">
		<div class="card-header py-2 d-flex align-items-center justify-content-between">
			<h6 class="font-weight-bold text-primary m-0">Data Transaksi</h6>
			<div>
				<a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">Tambah</a>
				<button class="btn btn-sm btn-success" data-toggle="collapse" data-target="#filter">Filter</button>
				<button class="btn btn-sm btn-info print">Print</button>
			</div>
		</div>
		<div class="card-body border-bottom collapse" id="filter">
		<form>
			<div class="form-row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Dari</label>
						<input type="date" class="form-control" name="from">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Sampai</label>
						<input type="date" class="form-control" name="till">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Status Pembayaran</label>
						<select name="payment_status" class="form-control custom-select">
							<option value="">Status Pembayaran</option>
							<option value="0">Belum Bayar</option>
							<option value="1">Sudah Bayar</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Status Pengerjaan</label>
						<select name="working_status" class="form-control custom-select">
							<option value="">Status Pengerjaan</option>
							<option value="0">Belum Selesai</option>
							<option value="1">Sudah Selesai</option>
						</select>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit">Filter</button>
		</form>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>Nota</th>
							<th>Tanggal</th>
							<th>Customer</th>
							<th>Paket</th>
							<th>Berat</th>
							<th>Status</th>
							<th>Total Bayar</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="modal paymentModal">
	<div class="modal-dialog">
	<div class="modal-content">
	<form action="">
		<div class="modal-header">
			<h5 class="modal-title">Update Pembayaran</h5>
			<button class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label>Status Pembayaran</label>
				<select name="payment_status" class="form-control custom-select">
					<option value="0">Belum Bayar</option>
					<option value="1">Sudah Bayar</option>
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" type="submit">Update</button>
			<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
		</div>
	</form>
	</div>
	</div>
	</div>

	<div class="modal workingModal">
	<div class="modal-dialog">
	<div class="modal-content">
	<form action="">
		<div class="modal-header">
			<h5 class="modal-title">Update Pengerjaan</h5>
			<button class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label>Status Pengerjaan</label>
				<select name="working_status" class="form-control custom-select">
					<option value="0">Belum Selesai</option>
					<option value="1">Sudah Selesai</option>
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" type="submit">Update</button>
			<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
		</div>
	</form>
	</div>
	</div>
	</div>

@endsection

@push('css')
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
	<script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

	<script>
		const ajaxUrl = '{{ route('transactions.datatables') }}'
		const printUrl = '{{ route('transactions.report') }}'
		const deleteUrl = '{{ route('transactions.destroy', ':id') }}'
		const paymentUrl = '{{ route('transactions.update.payment', ':id') }}'
		const workingUrl = '{{ route('transactions.update.working', ':id') }}'
		const csrf = '{{ csrf_token() }}'
	</script>

	<script src="{{ asset('js/transaction.js') }}"></script>
@endpush