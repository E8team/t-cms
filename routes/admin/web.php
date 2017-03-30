<?php
Route::get('/', 'IndexController@index');
Route::post('posts', 'Api\PostsController@store')->name('admin.posts.store');