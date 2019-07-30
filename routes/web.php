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

// backend routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('product/add','ProductController@addProduct');
Route::get('product/dashboard','ProductController@dashboard');
Route::get('product/delete/{id}','ProductController@deleteProduct');
Route::get('product/update/form/{id}','ProductController@updateProductForm'); //redirect user to another update form blade
Route::post('product/update','ProductController@updateProduct');
Route::get('product/restore/{id}','ProductController@restoreProduct');
Route::get('product/forceDelete/{id}','ProductController@forceDeleteProduct');


// Frontend routing
Route::get('/', 'FrontendController@index');
Route::get('product/details/{id}', 'FrontendController@productDetails');

