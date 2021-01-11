@extends('_layouts.app')

@section('title', 'Pengaturan')

@section('content')

	<div class="col-sm-6 mx-auto">
		@if (session()->has('success'))
			<div class="alert alert-success alert-dismissible">
				{{ session('success') }}
				<button class="close" data-dismiss="alert">&times;</button>
			</div>
		@endif
		<div class="card shadow">
		<form action="{{ route('setting.save') }}" method="post">
			@csrf
			@method('PUT')
			<div class="card-header py-3">
				<h6 class="font-weight-bold m-0 text-primary">Pengaturan</h6>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama" value="{{ setting('name') }}" autofocus>
					
					@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror			
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Deskripsi">{{ setting('description') }}</textarea>
					
					@error('description')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror			
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Simpan</button>
			</div>
		</form>
		</div>
	</div>

@endsection