<?php
$api->post('categories', 'CategoriesController@store');
$api->group(['middleware'=>'auth'], function ($api) {
    // -------------------------------------------------
    // 当前登录的用户
    $api->get('me', 'UsersController@me');
    // 用户列表
    $api->get('users', 'UsersController@lists');
    // 创建用户
    $api->post('users', 'UsersController@store');
    // 获取指定用户的信息
    $api->get('users/{user}', 'UsersController@show');
    // 更新用户
    $api->put('users/{user}', 'UsersController@update');
    // 删除用户
    $api->delete('users/{id}', 'UsersController@destroy');
    // -------------------------------------------------
    // 获取用户角色
    $api->get('users/{user}/roles', 'UsersController@roles');
    // 批量移动用户至角色 ?user_ids[0]=1&user_ids[1]=2&role_ids[0]=1&role_ids[1]=2
    $api->put('move_users_to_roles', 'UsersController@moveUsers2Roles');
    // 获取所有角色(不分页 用于添加用户时显示)
    $api->get('roles/all', 'RolesController@allRoles');
    // 角色列表
    $api->get('roles', 'RolesController@lists');
    // 获取指定角色的信息
    $api->get('roles/{role}', 'RolesController@show');
    $api->get('roles/{role}/permissions', 'RolesController@permissions');
    // 创建角色
    $api->post('roles', 'RolesController@store');
    // 更新角色
    $api->put('roles/{role}', 'RolesController@update');
    // 删除角色
    $api->delete('roles/{id}', 'RolesController@destroy');
    // -------------------------------------------------
    // 获取菜单
    $api->get('menus', 'PermissionsController@menus');
    // 获取所有权限(不分页 用于创建角色时显示)
    $api->get('permissions/all', 'PermissionsController@allPermissions');
    // 获取所有的父级权限
    $api->get('permissions/top', 'PermissionsController@getTopPermissions');
    //获取指定权限
    $api->get('permissions/{permission}', 'PermissionsController@show');
    // 获取指定权限下面的子级权限
    $api->get('permissions/{permission}/children', 'PermissionsController@getChildren');
    // 创建权限
    $api->post('permissions', 'PermissionsController@store');
    // 更新权限
    $api->put('permissions/{permission}', 'PermissionsController@update');
    //删除指定权限
    $api->delete('permissions/{id}', 'PermissionsController@destroy');
    //将权限批量移动到角色 ?permission_ids[0]=1&permission_ids[1]=2&role_ids[0]=1&role_ids[1]=2
    $api->put('move_permissions_to_roles', 'PermissionsController@movePermissions2Roles');
    // -------------------------------------------------
    //获取所有分类?type=post|page|ext_link
    $api->get('categories/all', 'CategoriesController@getAllCategory');
    // 获取所有的父级分类?type=post|page|ext_link
    $api->get('top_categories', 'CategoriesController@getTopCategories');
    // 获取指定分类下的子级分类?type=post|page|ext_link
    $api->get('categories/{category}/children', 'CategoriesController@getChildren');
    // 创建权限
    //$api->post('categories', 'CategoriesController@store');
    // 更新分类
    $api->put('categories/{category}', 'CategoriesController@update');
    //指定分类下的文章
    $api->get('categories/{category}/posts', 'CategoriesController@posts');
    //将文章批量移动到分类 ?post_ids[0]=1&post_ids[1]=2&category_ids[0]=4&category_ids[1]=5
    $api->put('move_posts_to_categories', 'PostsController@movePosts2Categories');
    // -------------------------------------------------
    // 获取指定文章
    $api->get('posts/{post}', 'PostsController@show');
    // 创建文章
    $api->post('posts', 'PostsController@store');
    // 更新文章
    $api->put('posts/{post}', 'PostsController@update');
    $api->delete('posts/{id}', 'PostsController@destroy');
    // -------------------------------------------------
    // 获取所有友情链接的类别
    $api->get('types/link', 'TypesController@links');
    // 创建类别
    $api->post('types', 'TypesController@store');
    // 更新类别
    $api->put('types/{type}', 'TypesController@update');
    // ---------------------------------------------------
    // 指定类别下面的友情链接 type如果不传表示获取所有分类下的友情链接
    $api->get('links/{type?}', 'LinksController@lists');
    // 创建友情链接
    $api->post('links', 'LinksController@store');
    // 更新友情链接
    $api->put('links/{link}', 'LinksController@update');
    // 删除指定的友情链接
    $api->delete('links/{id}', 'LinksController@destroy');
    // -------------------------------------------------
    $api->get('settings', 'SettingsController@lists');
    // 创建设置项
    $api->post('settings', 'SettingsController@store');
    // 更新设置项
    $api->put('settings/setting', 'SettingsController@update');

    // 获取所有主题
    $api->get('themes', 'ThemesController@lists');
    // 获取正文模板
    $api->get('themes/content_template', 'ThemesController@contentTemplate');
});



// auth 相关
$api->post('login', 'LoginController@login');

$api->get('nav', 'CategoriesController@nav');
