<?php

Route::get('/', 'DashboardController@index')->name('index');

Route::resources([
    'categories' => 'CategoryController',
    'posts' => 'PostController'
]);