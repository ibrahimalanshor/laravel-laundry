@extends('_layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
	
	<div class="col-md-6 mx-auto">
		<div class="card shadow">
		<form action="{{ route('customers.update', $customer->id) }}" method="post">
			@csrf
			@method('PUT')
			<div class="card-header py-3">
				<h6 class="font-weight-bold text-primary m-0">Edit Pelanggan</h6>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $customer->name }}" placeholder="Nama" autofocus>

					@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $customer->phone }}" placeholder="Telepon">

					@error('phone')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Alamat">{{ $customer->address }}</textarea>

					@error('address')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Edit</button>
				<a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
			</div>
		</form>
		</div>
	</div>

@endsection