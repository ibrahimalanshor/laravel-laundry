<?php 

namespace App\Repositories\Search;

interface SearchInterface {

	public function search(string $search = null): Object;

}

 ?>