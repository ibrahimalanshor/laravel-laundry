<?php 

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;

interface SearchInterface {

	public function search(Request $request): Object;

}

 ?>