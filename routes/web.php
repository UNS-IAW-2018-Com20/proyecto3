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


//Comisiones
Route::get('/comisiones', 'ComisionesController@index');

Route::get('/comisiones/eliminar/{id}', 'ComisionesController@eliminar');

Route::get('/comisiones/agregar','ComisionesController@agregarGet');

Route::post('/comisiones/agregar','ComisionesController@agregarPost');

Route::get('/comisiones/detalles/{id}','ComisionesController@detallesGet');

Route::post('/comisiones/detalles/{id}','ComisionesController@detallesPost');


//Evaluaciones
Route::get('/evaluaciones', 'EvaluacionesController@index');

Route::get('/evaluaciones/eliminar/{id}', 'EvaluacionesController@eliminar');

Route::get('/evaluaciones/agregar','EvaluacionesController@agregarGet');

Route::post('/evaluaciones/agregar','EvaluacionesController@agregarPost');

Route::get('/evaluaciones/detalles/{id}','EvaluacionesController@detallesGet');

Route::post('/evaluaciones/detalles/{id}','EvaluacionesController@detallesPost');

//Escalas
Route::get('/escalas', 'EscalaDeNotasController@index');

Route::get('/escalas/eliminar/{id}', 'EscalaDeNotasController@eliminar');

Route::get('/escalas/agregar','EscalaDeNotasController@agregarGet');

Route::post('/escalas/agregar','EscalaDeNotasController@agregarPost');

Route::get('/escalas/detalles/{id}','EscaladeNotasController@detallesGet');

Route::post('/escalas/detalles/{id}','EscalaDeNotasController@detallesPost');


//Index
Route::get('/', function () {
    return view('index');
});
