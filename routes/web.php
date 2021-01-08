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


//login
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

// home
Route::get('/', 'DashboardController@index');


// master user
Route::get('/user','UserController@index');
Route::post('/user', 'UserController@store');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::put('/user/{user}/edit', 'UserController@update');
Route::delete('/user/{user}/delete', 'UserController@destroy');

// master pelanggan
Route::get('/customer','CustomerController@index');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/{customer}/edit', 'CustomerController@edit');
Route::put('/customer/{customer}/edit', 'CustomerController@update');
Route::delete('/customer/{customer}/delete', 'CustomerController@destroy');

// master supplier
Route::get('/supplier','SupplierController@index');
Route::post('/supplier', 'SupplierController@store');
Route::get('/supplier/{supplier}/edit', 'SupplierController@edit');
Route::put('/supplier/{supplier}/edit', 'SupplierController@update');
Route::delete('/supplier/{supplier}/delete', 'SupplierController@destroy');

// master barang
Route::get('/stuff','StuffController@index');
Route::post('/stuff', 'StuffController@store');
Route::get('/stuff/{stuff}/edit', 'StuffController@edit');
Route::put('/stuff/{stuff}/edit', 'StuffController@update');
Route::delete('/stuff/{stuff}/delete', 'StuffController@destroy');


// pembelian
Route::get('/purchase','PurchaseController@index');
Route::post('/purchase', 'PurchaseController@store');

// penjualan
Route::get('/sales', 'SalesController@index');
Route::post('/sales', 'SalesController@store');


// laporan
Route::get('/report', 'ReportController@index');
Route::post('/report','ReportController@filter');
Route::get('/filter', 'ReportController@show');
