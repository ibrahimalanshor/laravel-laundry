<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\SaveSettingRequest;
use App\Repositories\SettingRepository;

use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{

	public function save(SaveSettingRequest $request, SettingRepository $settingRepo): RedirectResponse
	{
		$settingRepo->save($request->all());

		return redirect('/setting')->withSuccess('Sukses Menyimpan Pengaturan');
	}

}
