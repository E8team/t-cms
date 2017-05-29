<?php
Route::get('/', 'IndexController@index')->name('index');
Route::get('/blog', 'IndexController@blog')->name('blog');
Route::get('/category/{cateSlug}', 'IndexController@postList')->name('category');
Route::get('/category/{cateSlug}/post/{post}', 'IndexController@post')->name('post');

Route::group(
    ['middleware' => 'auth'], function () {
        Route::post('ajax_upload_picture', 'PicturesController@upload');
    }
);

Route::get('/s/{keywords}', 'SearchController@search')->name('search');