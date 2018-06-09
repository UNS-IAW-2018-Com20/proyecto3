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

Route::get('/alumnos', 'AlumnoController@index');

Route::get('/crearEscala', 'AdminController@formEscala');

Route::get('/crearComision', 'AdminController@formComision');

Route::get('/crearEvaluacion', 'AdminController@formEvaluacion');

Route::post('/crearEscala', 'AdminController@enviarEscala');

Route::post('/crearComision', 'AdminController@enviarComision');

Route::post('/crearEvaluacion', 'AdminController@enviarEvaluacion');

Route::get('/', function () {
    return view('index');
});
