<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function ()
{
	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/logout', 'AuthController@logout')->name('logout');

	Route::post('/users/datatables', 'UserController@datatables')->name('users.datatables');

	Route::prefix('customers')->name('customers.')->group(function ()
	{
		Route::post('/datatables', 'CustomerController@datatables')->name('datatables');
		Route::post('/search', 'CustomerController@search')->name('search');
	});

	Route::prefix('packets')->name('packets.')->group(function ()
	{
		Route::post('/datatables', 'PacketController@datatables')->name('datatables');
		Route::post('/search', 'PacketController@search')->name('search');
	});

	Route::prefix('transactions')->name('transactions.')->group(function ()
	{
		Route::post('/datatables', 'TransactionController@datatables')->name('datatables');
		Route::post('/search', 'TransactionController@search')->name('search');

		Route::get('/report', 'TransactionController@report')->name('report');		
		Route::get('/{transaction}/print', 'TransactionController@print')->name('print');		
		Route::patch('/{transaction}/update-payment', 'TransactionController@updatePayment')->name('update.payment');
		Route::patch('/{transaction}/update-working', 'TransactionController@updateWorking')->name('update.working');		
	});

	Route::prefix('setting')->name('setting.')->middleware('can:isAdmin')->group(function ()
	{
		Route::view('/', 'setting')->name('index');
		Route::put('/', 'SettingController@save')->name('save');
	});

	Route::resource('/users', 'UserController', ['except' => ['show']])->middleware('can:isAdmin');
	Route::resource('/customers', 'CustomerController', ['except' => ['show']]);
	Route::resource('/packets', 'PacketController', ['except' => ['show']]);
	Route::resource('/transactions', 'TransactionController');
});

Route::middleware('guest')->group(function ()
{
	Route::view('/login', 'auth.login');
	Route::post('/login', 'AuthController@login')->name('login');
});