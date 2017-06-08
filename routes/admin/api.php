<?php

$api->group(
    ['middleware'=>'auth'], function ($api) {

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
        $api->delete('users/{user}', 'UsersController@destroy');
        // 获取用户角色
        $api->get('users/{user}/roles', 'UsersController@roles');
        // 批量移动用户至角色 ?user_ids[0]=1&user_ids[1]=2&role_ids[0]=1&role_ids[1]=2
        $api->put('move_users_to_roles', 'UsersController@moveUsers2Roles');
        // -------------------------------------------------
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
        $api->delete('roles/{role}', 'RolesController@destroy');
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
        $api->delete('permissions/{permission}', 'PermissionsController@destroy');
        //将权限批量移动到角色 ?permission_ids[0]=1&permission_ids[1]=2&role_ids[0]=1&role_ids[1]=2
        $api->put('move_permissions_to_roles', 'PermissionsController@movePermissions2Roles');
        // -------------------------------------------------

        //获取所有分类?type=post|page|ext_link
        $api->get('categories/all', 'CategoriesController@getAllCategory');
        //获取所有分类?type=post|page|ext_link
        $api->get('categories/all', 'CategoriesController@getAllCategory');
        // 获取所有的父级分类?type=post|page|ext_link
        $api->get('top_categories', 'CategoriesController@getTopCategories');
        // 获取指定分类下的子级分类?type=post|page|ext_link
        $api->get('categories/{category}/children', 'CategoriesController@getChildren');
        // 创建分类
        $api->post('categories', 'CategoriesController@store');
        // 更新分类
        $api->put('categories/{category}', 'CategoriesController@update');
        // 获取指定分类
        $api->get('categories/{category}', 'CategoriesController@show');
        // 删除分类
        $api->delete('categories/{category}', 'CategoriesController@destroy');
        // 获取指定分类下的文章
        $api->get('categories/{category}/posts', 'CategoriesController@posts');
        // 获取指定分类下的单页
        $api->get('categories/{category}/page', 'CategoriesController@page');
        //将文章批量移动到分类 ?post_ids[0]=1&post_ids[1]=2&category_ids[0]=4&category_ids[1]=5
        $api->put('move_posts_to_categories', 'PostsController@movePosts2Categories');
        // -------------------------------------------------
        $api->get('posts', 'PostsController@lists');
        // 获取指定文章
        $api->get('posts/{post}', 'PostsController@show');
        // 创建文章
        $api->post('posts', 'PostsController@store');
        // 更新文章
        $api->put('posts/{post}', 'PostsController@update');
        // 创建或更新单网页
        $api->post('categories/{category}/page', 'PostsController@storePage');
        // 软删除指定的文章
        $api->delete('posts/{post}', 'PostsController@softDelete');
        // 真删除指定的文章
        $api->delete('posts/{postId}/force', 'PostsController@destruct');
        // 还原指定的被软删除的文章
        $api->post('posts/{post}/restore', 'PostsController@restore');
        // -------------------------------------------------
        // 获取某个model的所有类别
        $api->get('types/{model}', 'TypesController@getTypeByModel');
        // 创建类别
        $api->post('types', 'TypesController@store');
        // 更新类别
        $api->put('types/{type}', 'TypesController@update');
        // 删除分类
        $api->delete('types/{type}', 'TypesController@destroy');
        // ---------------------------------------------------
        // 获取所有的友情链接
        $api->get('links/type/all', 'LinksController@allLinks');
        // 指定类别下面的友情链接 type如果不传表示获取默认分类(type_id为null)的友情链接
        $api->get('links/type/{type?}', 'LinksController@lists');
        // 获取指定的友情链接
        $api->get('links/{link}', 'LinksController@show');
        // 创建友情链接
        $api->post('links', 'LinksController@store');
        // 更新友情链接
        $api->put('links/{link}', 'LinksController@update');
        // 删除指定的友情链接
        $api->delete('links/{link}', 'LinksController@destroy');
        // -------------------------------------------------
        // 获取所有的配置
        $api->get('settings/type/all', 'SettingsController@allSettings');
        // 指定类别下面的配置 type如果不传表示获取默认分类(type_id为null)的配置
        $api->get('settings/type/{type?}', 'SettingsController@lists');
        // 创建配置
        $api->post('settings', 'SettingsController@store');
        // 更新配置
        $api->put('settings/setting', 'SettingsController@update');

        // ------------------------------------------------
        // 获取所有主题
        $api->get('themes', 'ThemesController@lists');
        // 获取正文模板
        $api->get('themes/content_template', 'ThemesController@contentTemplate');
        // 当前主题的配置
        $api->get('themes/active_theme_config', 'ThemesController@activeThemeConfig');
        // 设置当前主题
        $api->put('themes/active_theme', 'ThemesController@setActiveTheme');

        // ---------------------------------------------------
        // 获取所有的banners
        $api->get('banners/type/all', 'BannersController@allBanners');
        // 指定类别下面的banners type如果不传表示获取默认分类(type_id为null)的banners
        $api->get('banners/type/{type?}', 'BannersController@lists');
        // 获取指定的banner
        $api->get('banners/{banner}', 'BannersController@show');
        // 创建banner
        $api->post('banners', 'BannersController@store');
        // 更新banner
        $api->put('banners/{banner}', 'BannersController@update');
        // 删除指定的banner
        $api->delete('banners/{banner}', 'BannersController@destroy');

}
);


// auth 相关
$api->post('login', 'LoginController@login');

$api->get('nav', 'CategoriesController@nav');
