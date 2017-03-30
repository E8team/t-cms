<?php

$api->get('post/{postId}', 'PostsController@show');
$api->get('posts', 'PostsController@index');
$api->get('slug/{title}','PostsController@slug');

// auth 相关
$api->group(['prefix' => 'auth'], function ($api){
    $api->post('login', 'Auth\LoginController@');
});