<?php

Route::apiResources([
    'categories' => 'CategoryController',
    'posts' => 'PostController'
]);

Route::post('posts/is-exists', 'PostController@isExists');