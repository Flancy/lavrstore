<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/catalog', 'Product\ProductController@index')->name('catalog.index');
Route::get('/product/{id}', 'Product\ProductController@show')->name('product.show');
Route::get('/catalog/{category}', 'Product\ProductController@category')->name('catalog.category');