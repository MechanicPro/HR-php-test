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

Route::get('/', 'WeatherController@show');
Route::get('/order', 'OrderController@show');
Route::get('/order{id}', 'OrderController@showItem');
Route::post('/order/{id}', 'OrderController@edit');
Route::get('/product', 'ProductController@show');
Route::get('/product&sort={param}', 'ProductController@sort');
Route::post('/product/edit', 'ProductController@edit');
