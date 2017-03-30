<?php

$api->get('post/{postId}', 'PostsController@show');

// auth 相关
$api->post('login', 'LoginController@login');
