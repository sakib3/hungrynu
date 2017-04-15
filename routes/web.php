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

Route::get('/products','ProductsController@index');
Route::post('/products','ProductsController@store');
Route::put('/products/{id}','ProductsController@update');

Route::get('/menus', 'MenusController@index');