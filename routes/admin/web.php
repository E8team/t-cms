<?php

Route::get('/{path?}/{path?}', 'IndexController@index')->where('path', '[\/\w\.-]*');
