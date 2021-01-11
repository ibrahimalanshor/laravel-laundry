<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;

use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{

	public function login(LoginRequest $request, AuthService $authService): RedirectResponse
	{
		$credentials = $request->only('email', 'password');
		$remember = $request->filled('remember');

		return $authService->login($credentials, $remember) 
			? redirect('/')->withSuccess('Sukses Login')
			: back()->withErrors(['password' => 'Password Wrong']);
	}

	public function logout(AuthService $auth): RedirectResponse
	{
		$auth->logout();

		return redirect('/login');
	}

}
