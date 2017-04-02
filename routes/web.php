<?php

Route::get('/', function (){
    return 'hello world!';
});
Route::get('pic/{img_id}_{size}_{suffix}', 'PicturesController@show')->name('image');

Route::group(['middleware' => 'auth'], function (){
   Route::post('ajax_upload_picture', 'PicturesController@upload');
});