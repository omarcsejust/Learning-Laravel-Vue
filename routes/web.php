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

Route::get('/', 'FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('product/add','ProductController@addProduct');
Route::get('product/form','ProductController@form');
Route::get('product/delete/{id}','ProductController@deleteProduct');
Route::get('product/update/form/{id}','ProductController@updateProductForm');
Route::post('product/update','ProductController@updateProduct');

