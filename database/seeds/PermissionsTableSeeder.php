<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
            [
                'id'=>1,
                'name' => 'admin.user',
                'display_name' => '用户管理',
                'description' => '用户管理',
                'parent_id' => 0,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>2,
                'name' => 'admin.post',
                'display_name' => '文章管理',
                'description' => '文章管理',
                'parent_id' => 0,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>3,
                'name' => 'admin.setting',
                'display_name' => '站点设置',
                'description' => '站点设置',
                'parent_id' => 0,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>4,
                'name' => 'admin.user.show',
                'display_name' => '用户列表',
                'description' => '显示用户列表',
                'parent_id' => 1,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>5,
                'name' => 'admin.user.roles',
                'display_name' => '角色列表',
                'description' => '显示角色列表',
                'parent_id' => 1,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>6,
                'name' => 'admin.user.permissions',
                'display_name' => '权限列表',
                'description' => '显示权限列表',
                'parent_id' => 1,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>7,
                'name' => 'admin.post.create',
                'display_name' => '写文章',
                'description' => '写文章',
                'parent_id' => 2,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>8,
                'name' => 'admin.post.show',
                'display_name' => '文章列表',
                'description' => '文章列表',
                'parent_id' => 2,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>9,
                'name' => 'admin.post.categories',
                'display_name' => '栏目管理',
                'description' => '栏目管理',
                'parent_id' => 2,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>10,
                'name' => 'admin.setting.configure',
                'display_name' => '站点配置',
                'description' => '站点配置',
                'parent_id' => 3,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>11,
                'name' => 'admin.setting.theme',
                'display_name' => '主题',
                'description' => '主题',
                'parent_id' => 3,
                'is_menu' => true,
                'order' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            ]
        );
    }
}
