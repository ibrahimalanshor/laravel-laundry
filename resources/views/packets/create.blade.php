@extends('_layouts.app')

@section('title', 'Tambah Paket')

@section('content')
	
	<div class="col-md-6 mx-auto">
		<div class="card shadow">
		<form action="{{ route('packets.store') }}" method="post">
			@csrf
			<div class="card-header py-3">
				<h6 class="font-weight-bold text-primary m-0">Tambah Paket</h6>
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
					<label>Harga (*kilo)</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp</span>
						</div>
						<input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Harga Per Kilo">

						@error('price')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror	
					</div>
				</div>
				<div class="form-group">
					<label>Waktu Pengerjaan (*hari)</label>
					<input type="number" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" placeholder="Waktu Pengerjaan Per Hari">

					@error('time')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}" placeholder="Keterangan"></textarea>

					@error('detail')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror	
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Tambah</button>
				<a href="{{ route('packets.index') }}" class="btn btn-secondary">Kembali</a>
			</div>
		</form>
		</div>
	</div>

@endsection

@push('js')
	<script>
		$('[name=price]').on('keyup', function () {
			const number = Number(this.value.replace(/\D/g, ''))
			const price = new Intl.NumberFormat().format(number)

			this.value = price
		})
	</script>
@endpush