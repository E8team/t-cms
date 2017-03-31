<?php

$api->get('post/{id}', 'PostsController@show');
$api->get('users', 'UsersController@lists');
$api->post('users', 'UsersController@store');
$api->get('user/{user}', 'UsersController@show');
$api->put('user/{user}', 'UsersController@update');
$api->group(['middleware'=>'auth'], function ($api) {
    $api->get('me', 'UsersController@me');
});


// auth 相关
$api->post('login', 'LoginController@login');
