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

/**
 * Pages Route(s)
 */
Route::get('/','PagesController@index')->name('pages.index');
Route::get('/about','PagesController@about')->name('pages.about');

/**
 * Todo Route(s)
 */
Route::resource('/todos','TodosController');


/**
 * The actual routes created by:
 * Route::resource('/todos','TodosController');
 */
/*
    Route::get('/todos','TodosController@index')->name('todos.index');
    Route::get('/todos/create','TodosController@create')->name('todos.create');
    Route::post('/todos','TodosController@store')->name('todos.store');
    Route::get('/todos/{id}','TodosController@show')->name('todos.show');
    Route::get('/todos/{id}/edit','TodosController@edit')->name('todos.edit');
    Route::put('/todos/{id}','TodosController@update')->name('todos.update');
    Route::delete('/todos/{id}','TodosController@destroy')->name('todos.destroy');
*/