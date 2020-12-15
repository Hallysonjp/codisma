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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/categories/', 'CategoriesController@index');
Route::get('/turmas/{disciplina_id}/{categoria_id}', 'CategoriesController@get_categories');
Route::get('/cursos/{curso_id}', 'CategoriesController@get_courses');
Route::get('/success/', 'HomeController@success');
Route::get('/{id}', 'HomeController@index');
Route::post('/matricula/store', "MatriculaController@store");
Route::post('/matricula/transaction', "MatriculaController@transaction");

