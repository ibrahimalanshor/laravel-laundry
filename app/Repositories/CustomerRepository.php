<?php 

namespace App\Repositories;

use App\Repositories\Search\SearchInterface;
use App\Models\Customer;

class CustomerRepository extends Repository implements SearchInterface {

	public function __construct(Customer $customer)
	{
		$this->model = $customer;
	}

	public function search(string $search = null): Object
	{
		return $this->model->where('name', 'like', '%'.$search.'%')->get(['id', 'name as text', 'address', 'phone']);
	}

}

 ?>