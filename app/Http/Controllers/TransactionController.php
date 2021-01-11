<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Datatables\DatatablesInterface;
use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Requests\Transaction\UpdatePaymentRequest;
use App\Http\Requests\Transaction\UpdateWorkingRequest;
use App\Repositories\TransactionRepository;
use App\Services\Transaction\TransactionDatatables;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller implements DatatablesInterface
{

    protected $transactionRepo;
    protected $transactionDatatables;

    public function __construct(TransactionRepository $transactionRepo, TransactionDatatables $transactionDatatables)
    {
        $this->transactionRepo = $transactionRepo;
        $this->transactionDatatables = $transactionDatatables;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request): RedirectResponse
    {
        $this->transactionRepo->create($request->all());

        return redirect('/transactions')->withSuccess('Sukses Membuat Transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): View
    {
        $transaction = $this->transactionRepo->find($id);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $transaction = $this->transactionRepo->find($id);

        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, int $id): RedirectResponse
    {
        $this->transactionRepo->update($id, $request->all());

        return redirect('/transactions')->withSuccess('Sukses Mengedit Transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $this->transactionRepo->delete($id);

        return response()->json('Sukses Menghapus Transaksi');
    }

    // Update Payment
    public function updatePayment(UpdatePaymentRequest $request, int $id): JsonResponse
    {
        $this->transactionRepo->update($id, $request->all());

        return response()->json('Sukses Mengupdate Pembayaran');
    }

    // Update Working
    public function updateWorking(UpdateWorkingRequest $request, int $id): JsonResponse
    {
        $this->transactionRepo->update($id, $request->all());

        return response()->json('Sukses Mengupdate Pengerjaan');
    }

    // Print
    public function print(int $id): View
    {
        $transaction = $this->transactionRepo->find($id);

        return view('transactions.print', compact('transaction'));
    }

    // Report
    public function report(Request $request): View
    {
        extract($request->only('from', 'till', 'payment_status', 'working_status'));
        $transactions = $this->transactionRepo->get($from, $till, $payment_status, $working_status);

        return view('transactions.report', compact('transactions'));
    }

    // Datatables
    public function datatables(Request $request): Object
    {
        $this->transactionDatatables->setFilter($request->only('from', 'till', 'payment_status', 'working_status'));
        return $this->transactionDatatables->get();
    }
}
