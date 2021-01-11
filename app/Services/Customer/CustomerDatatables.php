<?php 

namespace App\Services\Customer;

use App\Repositories\CustomerRepository;
use App\Services\Datatables\DatatablesInterface;

use Yajra\Datatables\Datatables;

class CustomerDatatables implements DatatablesInterface {

	protected $data;

	public function __construct(CustomerRepository $customerRepo)
	{
		$this->data = $customerRepo->get();
	}

	public function get(): Object
	{
		$datatables = Datatables::of($this->data)
					->addIndexColumn()
					->addColumn('action', function ($customer)
					{
						return '
							<a href="'.route('customers.edit', $customer->id).'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
							<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
						';
					})
					->make();

		return $datatables;
	}

}

 ?>