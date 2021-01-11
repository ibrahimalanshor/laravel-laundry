<?php 

namespace App\Services\Packet;

use App\Repositories\PacketRepository;
use App\Services\Datatables\DatatablesInterface;

use Yajra\Datatables\Datatables;

class PacketDatatables implements DatatablesInterface {

	protected $data;

	public function __construct(PacketRepository $packetRepo)
	{
		$this->data = $packetRepo->get();
	}

	public function get(): Object
	{
		$datatables = Datatables::of($this->data)
					->addIndexColumn()
					->editColumn('price', function ($packet)
					{
						return $packet->priceText;
					})
					->editColumn('time', function ($packet)
					{
						return $packet->timeText;
					})
					->addColumn('action', function ($packet)
					{
						return '
							<a href="'.route('packets.edit', $packet->id).'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
							<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
						';
					})
					->make();

		return $datatables;
	}

}

 ?>