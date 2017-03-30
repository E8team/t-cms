<?php


Route::get('pic/{img_id}_{size}_{suffix}', 'PicturesController@show')->name('image');

