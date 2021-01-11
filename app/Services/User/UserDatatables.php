<?php 

namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Services\Datatables\DatatablesInterface;

use Yajra\Datatables\Datatables;

class UserDatatables implements DatatablesInterface {

	protected $data;

	public function __construct(UserRepository $userRepo)
	{
		$this->data = $userRepo->get();
	}

	public function get(): Object
	{
		$datatables = Datatables::of($this->data)
					->addIndexColumn()
					->addColumn('action', function ($user)
					{
						return '
							<a href="'.route('users.edit', $user->id).'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
							<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
						';
					})
					->make();

		return $datatables;
	}

}

 ?>