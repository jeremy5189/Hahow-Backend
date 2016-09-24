<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function() {
    return view('post');
});

Route::get('/posts/{id}', function($id) {
    return view('post-single', [
        'id' => $id
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/user', 'UserController@index');
Route::get('/user/delete/{id}', 'UserController@destroy');
Route::post('/user', 'UserController@store');

Route::get('/products', 'ProductController@list');
Route::get('/products/add_cart/{id}', 'ProductController@add_cart');
Route::get('/products/list_cart', 'ProductController@list_cart');
Route::get('/cart', 'ProductController@cart');
