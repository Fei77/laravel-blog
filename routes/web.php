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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController')->only(['index', 'show']);
Route::resource('/tags', 'TagController')->only(['index', 'show']);
Route::resource('/categories', 'CategoryController')->only(['index', 'show']);

Route::get('/posts/search', 'PostController@seatch')->name('posts.search');