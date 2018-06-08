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

Route::get('/crearEscala', 'AdminController@crearEscala');

Route::get('/crearComision', 'AdminController@formComision');

Route::get('/crearExamen', 'AdminController@formExamen');

Route::post('/enviarEscala', 'AdminController@guardarEscala');

Route::post('/enviarComision', 'AdminController@guardarComision');

Route::get('/', function () {
    return view('index');
});
