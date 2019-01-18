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

Route::get('/', 'Controller@help');
Route::get('/whatisyamipo', 'Controller@help');
Route::get('/welcome', 'Controller@help');
Route::get('/user/{screen_name}', 'UsersController@show');
Route::get('/user/myprofile/edit', 'UsersController@edit');
Route::patch('/user/{screen_name}/update', 'UsersController@update');
Route::get('/post/index', 'PostsController@index');
Route::get('/post/new', 'PostsController@new');
Route::post('/post', 'PostsController@create');
Route::get('/post/{id}', 'PostsController@show');
Route::get('/post/{id}/edit', 'PostsController@edit');
Route::patch('/post/{id}/update', 'PostsController@update');
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
Route::post('/user/{user}/follow', 'UsersController@follow');
Route::delete('/user/{user}/unfollow', 'UsersController@unfollow');
Route::get('/follower/{screen_name}', 'UsersController@follower');
Route::get('/following/{screen_name}', 'UsersController@following');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
