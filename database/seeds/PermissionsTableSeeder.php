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
        DB::table('permissions')->insert([
            [
                'id'=>1,
                'name' => 'admin.permission.manager',
                'display_name' => '权限管理',
                'description' => '权限管理',
                'parent_id' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>2,
                'name' => 'admin.user.manager',
                'display_name' => '用户管理',
                'description' => '用户管理',
                'parent_id' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>3,
                'name' => 'admin.user.list',
                'display_name' => '显示用户列表',
                'description' => '显示用户列表',
                'parent_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>4,
                'name' => 'admin.user.edit',
                'display_name' => '编辑用户',
                'description' => '编辑用户',
                'parent_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id'=>5,
                'name' => 'admin.permission.list',
                'display_name' => '显示权限列表',
                'description' => '显示权限列表',
                'parent_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
