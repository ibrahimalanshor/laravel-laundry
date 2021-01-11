<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Datatables\DatatablesInterface;
use App\Http\Controllers\Search\SearchInterface;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Services\Customer\CustomerDatatables;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller implements DatatablesInterface, SearchInterface
{

    protected $customerRepo, $customerDatatables;

    public function __construct(CustomerRepository $customerRepo, CustomerDatatables $customerDatatables)
    {
        $this->customerRepo = $customerRepo;
        $this->customerDatatables = $customerDatatables;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request): RedirectResponse
    {
        $this->customerRepo->create($request->all());

        return redirect('/customers')->withSuccess('Sukses Menambahkan Pelanggan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $customer = $this->customerRepo->find($id);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, int $id): RedirectResponse
    {
        $this->customerRepo->update($id, $request->all());

        return redirect('/customers')->withSuccess('Sukses Mengedit Pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $this->customerRepo->delete($id);

        return response()->json('Sukses Menghapus Pelanggan');
    }

    public function datatables(Request $request): Object
    {
        return $this->customerDatatables->get();
    }

    public function search(Request $request): Object
    {
        return $this->customerRepo->search($request->name);
    }
}
