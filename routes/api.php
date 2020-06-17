<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', 'UserController')->except(['create', 'edit']);
Route::resource('empresa', 'EmpresasController')->except(['create', 'edit']);
Route::resource('venta_empresa', 'VentasEmpresasController')->except(['create', 'edit']);

Route::get('venta_empresa/venta/{empresa_id}', 'VentasEmpresasController@totalSold')->name('venta.total');

Route::resource('diego', 'DiegoController')->except(['create', 'edit']);
