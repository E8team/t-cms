<?php

$api->get('post/{post}', 'PostsController@show');

$api->group(['middleware'=>'auth'], function ($api) {
    $api->get('me', 'UsersController@me');
    $api->get('users', 'UsersController@lists');
    $api->post('users', 'UsersController@store');
    $api->get('user/{user}', 'UsersController@show');
    $api->put('user/{user}', 'UsersController@update');
    $api->delete('user/{id}', 'UsersController@destroy');

});


// auth 相关
$api->post('login', 'LoginController@login');
