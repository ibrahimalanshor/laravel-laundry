<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;

use Illuminate\View\View;

class HomeController extends Controller
{

	public function index(): View
	{
		$data = $this->getData();

		return view('home', $data);
	}

	public function getData(): Array
	{
		$transaction = app(TransactionRepository::class);
		return [
			'totalTransactionByMonth' => $transaction->countByMonth(),
			'totalTransaction' => $transaction->count(),
			'totalIncomeByMonth' => number_format($transaction->countIncomeByMonth()),
			'totalIncome' => number_format($transaction->countIncome())
		];
	}

}
