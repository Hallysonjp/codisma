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

Route::get('/entrar', 'AuthController@index');
Route::get('/register', 'AuthController@register');


Route::get('/categories/', 'CategoriesController@index');
Route::get('/turmas/{disciplina_id}/{categoria_id}', 'CategoriesController@get_categories');
Route::get('/cursos/{curso_id}', 'CategoriesController@get_courses');
Route::get('/success/', 'InicioController@success');
Route::get('/{id}', 'InicioController@index');
Route::post('/matricula/store', "MatriculaController@store");
Route::post('/matricula/transaction', "MatriculaController@transaction");
Route::get('/matriculas/listar', "MatriculaController@index");

Route::post('signup', 'AuthController@signup')->name('register');
Route::post('login', 'AuthController@login')->name('login');
Route::post('logout', 'AuthController@logout')->name('logout');


