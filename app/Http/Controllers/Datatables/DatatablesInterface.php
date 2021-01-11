<?php 

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;

interface DatatablesInterface {

	public function datatables(Request $request): Object;

}

 ?>