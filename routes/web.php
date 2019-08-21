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

// ::::::::::::::::: Backend routes :::::::::::::::::::::::::
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Product routes
Route::post('product/add','ProductController@addProduct');
Route::get('product/dashboard','ProductController@dashboard');
Route::get('product/delete/{id}','ProductController@deleteProduct');
Route::get('product/update/form/{id}','ProductController@updateProductForm'); //redirect user to another update form blade
Route::post('product/update','ProductController@updateProduct');
Route::get('product/restore/{id}','ProductController@restoreProduct');
Route::get('product/forceDelete/{id}','ProductController@forceDeleteProduct');

// Category routes
Route::get('category/view','CategoryController@viewCategoryDashboard');
Route::post('category/add','CategoryController@addCategory');
Route::get('category/vue/view','CategoryController@viewCategoryDashboardByVueComponent');

//Customer controller routes
Route::get('customer/admin','CustomerController');


// ::::::::::::::::::::::::Frontend routing ::::::::::::::::::::::::
Route::get('/', 'FrontendController@index');
Route::get('product/details/{id}', 'FrontendController@productDetails');

