<?php 

namespace App\Services\Datatables;

interface TransactionDatatablesInterface {

	public function get(string $from = null, string $till = null, bool $payment_status = null, bool $working_status = null): Object;
	
}

 ?>