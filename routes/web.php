<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\HomeController;
use app\Http\Controllers\CitaController;
use app\Http\Controllers\ServiciosController;


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

// SECCION DE SERVICIOS
Route::get('/Servicios','ServiciosController@index');
Route::get('/Servicios/Crear','ServiciosController@crear');
Route::post('/Servicios/Guardar','ServiciosController@save');
Route::get('/Servicios/Editar/{id}','ServiciosController@editar');
Route::get('/Servicios/Detalle/{id}','ServiciosController@detalle');
Route::post('/Servicios/Actualizar/{id}','ServiciosController@update');
Route::get('/Servicios/CambioEstado/{id}/{estado}','ServiciosController@updateEstado');
Route::get('/Servicios/Listar','ServiciosController@listar');


// SECCION DE CITAS
Route::get('/Cita','CitaController@index');
Route::get('/Cita/Crear','CitaController@crear');
Route::post('/Cita/Guardar','CitaController@guardar');
Route::get('/Cita/Editar/{id}','CitaController@editar');
Route::get('/Cita/Detalle/{id}','CitaController@detalle');
Route::post('/Cita/Actualizar','CitaController@update');
Route::get('/Cita/CambioEstado/{id}/{estado}','CitaController@updateEstado');
Route::get('/Cita/Listar','CitaController@listar');

