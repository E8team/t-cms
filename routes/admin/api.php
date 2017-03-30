<?php

$api->get('post/{postId}', 'PostsController@show');

// auth 相关
$api->group(['prefix' => 'auth'], function ($api){
    $api->post('login', 'Auth\LoginController@');
});