<?php

$api->get('post/{postId}', 'PostsController@show');
$api->get('users', 'UsersController@lists');

// auth 相关
$api->post('login', 'LoginController@login');
