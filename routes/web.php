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

Route::get('/', 'PostsController@profile');
Route::get('/whatisyamipo', 'Controller@help');
Route::get('/user/{screen_name}', 'PostsController@profile');
Route::get('/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');