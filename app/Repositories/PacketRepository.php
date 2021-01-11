<?php 

namespace App\Repositories;

use App\Repositories\Search\SearchInterface;
use App\Models\Packet;

class PacketRepository extends Repository implements SearchInterface {

	public function __construct(Packet $packet)
	{
		$this->model = $packet;
	}

	public function search(string $search = null): Object
	{
		return $this->model->where('name', 'like', '%'.$search.'%')->get(['id', 'name as text', 'price', 'time']);
	}

}

 ?>