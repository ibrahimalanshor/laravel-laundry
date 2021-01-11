@extends('_layouts.app')

@section('title', 'Dashboard')

@section('content')
	@if (session()->has('success'))
		<div class="alert alert-success alert-dismissible">
			{{ session('success') }}
			<button class="close" data-dismiss="alert">&times;</button>
		</div>
	@endif
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaksi Bulan Ini</div>
							<div class="font-weight-bold mb-0 h5 text-gray-800">{{ $totalTransactionByMonth }}</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-calculator fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan Bulan Ini</div>
							<div class="font-weight-bold mb-0 h5 text-gray-800">Rp {{ $totalIncomeByMonth }}</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-money-bill fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi</div>
							<div class="font-weight-bold mb-0 h5 text-gray-800">{{ $totalTransaction }}</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-file-invoice fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pemasukan</div>
							<div class="font-weight-bold mb-0 h5 text-gray-800">Rp {{ $totalIncome }}</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-money-bill-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection