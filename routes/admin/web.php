<?php

Route::get('/{path?}', 'IndexController@index')->where('path', '[\/\w\.-]*');
