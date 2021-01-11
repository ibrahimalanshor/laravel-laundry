<?php 

namespace App\Repositories;

class Repository {

	public $model;

	public function create(array $data): Object
	{
		return $this->model->create($data);
	}

	public function update(int $id, array $data)
	{
		return $this->find($id)->update($data);
	}

	public function delete(int $id)
	{
		return $this->find($id)->delete($id);
	}

	public function find(int $id): Object
	{
		return $this->model->findOrFail($id);
	}

	public function get(): Object
	{
		return $this->model->latest()->get();
	}

	public function count(): Int
	{
		return $this->model->count();
	}

}

 ?>