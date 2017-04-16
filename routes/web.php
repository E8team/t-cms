<?php
Route::get('/', 'IndexController@index')->name('index');
Route::get('/list/{cateSlug}', 'IndexController@postList')->name('list');
Route::get('/content/{post}', 'IndexController@content')->name('content');

Route::get('pic/{img_id}_{size}_{suffix}', 'PicturesController@show')->name('image');

Route::group(['middleware' => 'auth'], function (){
   Route::post('ajax_upload_picture', 'PicturesController@upload');
});

