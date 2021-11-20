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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('empleado', 'EmpleadoController');
Route::resource('producto', 'ProductoController');
Route::resource('venta', 'VentaController');

Route::post('/producto/update_stock', 'ProductoController@updateStock')->name('update_stock');
Route::post('/producto/search', 'ProductoController@searchProducto')->name('searchProducto');
Route::post('/venta/store', 'VentaController@store')->name('storeProducto');

