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

Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');
Route::post('/posts', 'PostController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/user', 'UserController@index');
Route::get('/user/delete/{id}', 'UserController@destroy');
Route::post('/user', 'UserController@store');
