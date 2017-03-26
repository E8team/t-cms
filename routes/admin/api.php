<?php

$api->get('post/{postId}', 'PostsController@show');
$api->get('posts', 'PostsController@index');
$api->get('slug/{title}','PostsController@slug');