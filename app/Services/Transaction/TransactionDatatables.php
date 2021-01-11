<?php 

namespace App\Services\Transaction;

use App\Repositories\TransactionRepository;
use App\Services\Datatables\DatatablesInterface;

use Yajra\Datatables\Datatables;

class TransactionDatatables implements DatatablesInterface {

	protected $transactionRepo;
	protected $filter = [];

	public function __construct(TransactionRepository $transactionRepo)
	{
		$this->transactionRepo = $transactionRepo;
	}

	public function setFilter(array $filter)
	{
		$this->filter = $filter;
	}

	public function get(): Object
	{
		extract($this->filter);
		$datatables = Datatables::of($this->transactionRepo->get($from, $till, $payment_status, $working_status))
					->editColumn('total', function ($transaction)
					{
						return $transaction->totalFormatted;
					})
					->editColumn('weight', '{{ $weight }} Kg')
					->addColumn('date', function ($transaction)
					{
						return $transaction->date;
					})
					->addColumn('status', function ($transaction)
					{
						return $transaction->paymentStatusBadge.' '.$transaction->workingStatusBadge;
					})
					->addColumn('action', function ($transaction)
					{
						return '<div class="btn-group">
									<button class="btn btn-sm btn-primary">Aksi</button>
									<button class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
									<ul class="dropdown-menu">
										<li><a href="" class="dropdown-item payment">Update Pembayaran</a></li>
										<li><a href="" class="dropdown-item working">Update Pengerjaan</a></li>
										<li><a href="'.route('transactions.edit', $transaction->id).'" class="dropdown-item">Edit</a></li>
										<li><a href="'.route('transactions.show', $transaction->id).'" class="dropdown-item">Detail</a></li>
										<li><a href="" class="dropdown-item delete">Hapus</a></li>
									</ul>
								</div>
						';
					})
					->rawColumns(['action', 'status'])
					->make();

		return $datatables;
	}

}

 ?>