<?php

Route::get('/{path?}', 'IndexController@index')->where('path', '[\/\w\.-]*');
Route::get('/theme/{themeId}', 'IndexController@theme')->name('laravel-theme');
