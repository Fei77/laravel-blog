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


Route::get('test', function() {
    $arr = [1,2,3,4,5,6,7,8,9];

    return array_rand_value($arr, 9);
});

