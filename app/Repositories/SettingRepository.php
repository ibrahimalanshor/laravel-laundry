<?php 

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository {

	protected $setting;

	public function __construct(Setting $setting)
	{
		$this->setting = $setting->first();
	}

	public function save(array $data)
	{
		$this->setting->update($data);
	}

}

 ?>