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

Route::get('/cart', 'Cart\CartController@index')->name('cart.index');
Route::post('/cart/add', 'Cart\CartController@add')->name('cart.store');
Route::post('/cart/update', 'Cart\CartController@update')->name('cart.update');
Route::post('/cart/remove', 'Cart\CartController@remove')->name('cart.remove');
Route::post('/cart/clear', 'Cart\CartController@clear')->name('cart.clear');

Route::get('/cart/order', 'Cart\CartController@order')->name('cart.order');
Route::post('/cart/order', 'Cart\OrderController@order')->name('cart.order.post');

Route::get('/question', 'Question\QuestionController@index')->name('question.index');

Route::get('/contact', 'Contact\ContactController@index')->name('contact.index');