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

Auth::routes();

Route::group(['prefix' => 'sales', 'middleware' => ['auth']], function() {
    Route::get('create', 'SalesController@add')->name('sales.create');
    Route::post('create', 'SalesController@create')->name('sales.create');
    Route::get('index', 'SalesController@index')->name('sales.index');
    Route::get('search', 'SalesController@search')->name('sales.search');
    Route::get('result', 'SalesController@result')->name('sales.result');
    Route::post('result', 'SalesController@result')->name('sales.result');
    Route::get('edit', 'SalesController@edit')->name('sales.edit');
    Route::post('update', 'SalesController@update')->name('sales.edit');
    Route::get('delete', 'SalesController@delete')->name('sales.delete');
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth']], function() {
    Route::get('index', 'ClientsController@index')->name('clients.index');
    Route::get('create', 'ClientsController@add')->name('clients.create');
    Route::post('create', 'ClientsController@create')->name('clients.create');
    Route::get('edit', 'ClientsController@edit')->name('clients.edit');
    Route::post('update', 'ClientsController@update')->name('clients.edit');
    Route::get('delete', 'ClientsController@delete')->name('clients.delete');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function() {
    Route::get('index', 'Admin\UsersController@index')->name('admin.index');
    Route::get('create', 'Admin\UsersController@add')->name('admin.create');
    Route::post('create', 'Admin\UsersController@create')->name('admin.create');
    Route::get('edit', 'Admin\UsersController@edit')->name('admin.edit');
    Route::post('update', 'Admin\UsersController@update')->name('admin.edit');
    Route::get('delete', 'Admin\UsersController@delete')->name('admin.delete');
    Route::get('pass_set', 'Admin\UsersController@pass_set')->name('admin.pass_set');
    Route::post('pass_reset', 'Admin\UsersController@pass_reset')->name('admin.pass_reset');
});

// Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
//     Route::get('index', 'Admin\UsersController@index')->name('admin.index');
// });

Route::get('/', 'SalesController@index')->name('sales.index')->middleware('auth');
Route::get('/home', 'SalesController@index')->name('sales.index')->middleware('auth');