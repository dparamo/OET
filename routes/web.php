<?php

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

Route::resource('/propietario', 'PropietarioController');
Route::get('/propietarios', 'PropietarioController@buscar');

Route::resource('/conductor', 'ConductorController');
Route::get('/conductores', 'ConductorController@buscar');

Route::resource('/vehiculo', 'VehiculoController');
Route::get('/vehiculos', 'VehiculoController@buscar');

Route::resource('/informe', 'InformeController');



