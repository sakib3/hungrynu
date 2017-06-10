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
Route::post('/menus', 'MenusController@store');
Route::put('/menus/{id}', 'MenusController@update');

Route::get('/cart', 'CartsController@index');
Route::post('/cart', 'CartsController@store');
Route::put('/cart/{id}', 'CartsController@update');
Route::put('/cart', 'CartsController@updateBulk');
Route::delete('/cart', 'CartsController@delete');