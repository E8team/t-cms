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
    // 更新角色
    $api->put('roles/{role}', 'RolesController@update');
    // 删除角色
    $api->delete('role/{id}', 'RolesController@destroy');
    // 获取菜单
    $api->get('menus', 'PermissionsController@menus');
    // 获取所有的父级权限
    $api->get('topPermissions', 'PermissionsController@getTopPermissions');
    // 获取某个权限下面的子级权限
    $api->get('permissions/{permission}/children', 'PermissionsController@getChildren');


    $api->get('post/{post}', 'PostsController@show');
});


// auth 相关
$api->post('login', 'LoginController@login');
