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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'ProductController@index')->name('index');

Route::resource('products', 'ProductController');

Route::post('/products/search', 'ProductController@search')->name('products.search');

Route::get('/show_cart', 'ProductController@show_cart')->name('products.show_cart');
Route::get('/add_to_cart/{id}','ProductController@add_to_cart')->name('products.add_to_cart');
Route::get('/cart_quantity_up/{id}', 'ProductController@cart_quantity_up')->name('products.cart_quantity_up');
Route::get('/cart_quantity_down/{id}', 'ProductController@cart_quantity_down')->name('products.cart_quantity_down');
Route::get('/cart_item_delete/{id}', 'ProductController@cart_item_delete')->name('products.cart_item_delete');
Route::get('/empty_cart', 'ProductController@empty_cart')->name('products.empty_cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
