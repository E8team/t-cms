<?php



$api->group(['middleware'=>'auth'], function ($api) {
    // 当前登录的用户
    $api->get('me', 'UsersController@me');
    // 用户列表
    $api->get('users', 'UsersController@lists');
    // 创建用户
    $api->post('users', 'UsersController@store');
    // 获取某个用户的信息
    $api->get('users/{user}', 'UsersController@show');
    // 更新用户
    $api->put('users/{user}', 'UsersController@update');
    // 删除用户
    $api->delete('users/{id}', 'UsersController@destroy');
    // 获取用户角色
    $api->get('users/{user}/roles', 'UsersController@roles');

    // 角色列表
    $api->get('roles', 'RolesController@lists');
    // 获取某个角色的信息
    $api->get('roles/{role}', 'RolesController@show');
    // 创建角色
    $api->post('roles', 'RolesController@store');
    // 更新角色
    $api->put('roles/{role}', 'RolesController@update');
    // 删除角色
    $api->delete('roles/{id}', 'RolesController@destroy');
    // 获取菜单
    $api->get('menus', 'PermissionsController@menus');
    // 获取所有的父级权限
    $api->get('top_permissions', 'PermissionsController@getTopPermissions');
    // 获取某个权限下面的子级权限
    $api->get('permissions/{permission}/children', 'PermissionsController@getChildren');
    // 创建权限
    $api->post('permissions', 'PermissionsController@store');
    // 更新权限
    $api->put('permissions/{permission}', 'PermissionsController@update');

    // 获取所有的父级分类
    $api->get('top_categories', 'CategoriesController@getTopCategories');
    // 获取某个权限下面的子级权限
    $api->get('categories/{category}/children', 'CategoriesController@getChildren');
    // 创建权限
    $api->post('categories', 'CategoriesController@store');
    // 更新分类
    $api->put('categories/{category}', 'CategoriesController@update');
    //某个分类下的文章
    $api->get('categories/{category}/posts', 'CategoriesController@posts');
    //将文章批量移动到分类 ?post_ids[0]=1&post_ids[1]=2&category_ids[0]=4&category_ids[1]=5
    $api->put('move_posts_to_categories', 'PostsController@movePosts2Categories');

    $api->get('post/{post}', 'PostsController@show');
});


// auth 相关
$api->post('login', 'LoginController@login');

$api->get('nav', 'CategoriesController@nav');
