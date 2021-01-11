@extends('_layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
	
	<div class="col-md-6 mx-auto">
		<div class="card shadow">
		<form action="{{ route('users.store') }}" method="post">
			@csrf
			<div class="card-header py-3">
				<h6 class="font-weight-bold text-primary m-0">Tambah Petugas</h6>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama" autofocus>

					@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">

					@error('email')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

					@error('password')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Konfirmasi Password</label>
					<input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Tambah</button>
				<a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
			</div>
		</form>
		</div>
	</div>

@endsection