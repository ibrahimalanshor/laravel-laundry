<?php 

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends Repository {

	public function __construct(Transaction $transaction)
	{
		$this->model = $transaction;
	}

	public function find(int $id): Object
	{
		return $this->model->with(['customer', 'packet'])->findOrFail($id);
	}

	public function get(string $from = null, string $till = null, bool $payment_status = null, bool $working_status = null): Object
	{
		return $this->model->with(['customer:id,name', 'packet:id,name'])->when($from, function ($transaction, $from)
		{
			return $transaction->whereDate('created_at', '>=', $from);
		})->when($till, function ($transaction, $till)
		{
			return $transaction->whereDate('created_at', '<=', $till);
		})->when($payment_status !== null, function ($transaction) use ($payment_status)
		{
			return $transaction->wherePaymentStatus($payment_status);
		})->when($working_status !== null, function ($transaction) use ($working_status)
		{
			return $transaction->whereWorkingStatus($working_status);
		})->latest()->get();
	}

	public function countByMonth(): Int
	{
		return $this->model->whereMonth('created_at', date('m'))->count();
	}

	public function countIncome(): Int
	{
		return $this->model->sum('total');
	}

	public function countIncomeByMonth(): Int
	{
		return $this->model->whereMonth('created_at', date('m'))->sum('total');
	}

}

 ?>