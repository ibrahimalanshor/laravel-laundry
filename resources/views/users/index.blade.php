@extends('_layouts.app')

@section('title', 'Data Petugas')

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
			<h6 class="font-weight-bold text-primary m-0">Data Petugas</h6>
			<a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Tambah</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Role</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
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
		const ajaxUrl = '{{ route('users.datatables') }}'
		const deleteUrl = '{{ route('users.destroy', ':id') }}'
		const csrf = '{{ csrf_token() }}'
	</script>

	<script src="{{ asset('js/user.js') }}"></script>
@endpush