<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'id' => 1,
                    'type' => 0,
                    'cate_name' => '学院概况',
                    'description' => '学院概况',
                    'cate_slug' => 'department-profile',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'page_template' => 'post.page',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 2,
                    'type' => 1,
                    'cate_name' => '院长寄语',
                    'description' => '院长寄语',
                    'cate_slug' => 'dean-message',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'page_template' => 'post.page',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 3,
                    'type' => 1,
                    'cate_name' => '师资队伍',
                    'description' => '师资队伍',
                    'cate_slug' => 'teaching-staff',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'page_template' => 'post.page',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 4,
                    'type' => 1,
                    'cate_name' => '教学管理',
                    'description' => '教学管理',
                    'cate_slug' => 'teaching-management',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 5,
                    'type' => 0,
                    'cate_name' => '科学研究',
                    'description' => '科学研究',
                    'cate_slug' => 'scientific-research',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 6,
                    'type' => 0,
                    'cate_name' => '党团建设',
                    'description' => '党团建设',
                    'cate_slug' => 'party-building',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 7,
                    'type' => 0,
                    'cate_name' => '招生就业',
                    'description' => '招生就业',
                    'cate_slug' => 'Enrollment-and-employment',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 8,
                    'type' => 0,
                    'cate_name' => '校友风采',
                    'description' => '校友风采',
                    'cate_slug' => 'alumni-mien',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 9,
                    'type' => 0,
                    'cate_name' => '资料下载',
                    'description' => '资料下载',
                    'cate_slug' => 'data-download',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 10,
                    'type' => 1,
                    'cate_name' => '联系我们',
                    'description' => '联系我们',
                    'cate_slug' => 'contact-us',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'page_template' => 'post.page',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 11,
                    'type' => 1,
                    'cate_name' => '学院简介',
                    'description' => '学院简介',
                    'cate_slug' => 'xyjj',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'page_template' => 'post.page',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 12,
                    'type' => 0,
                    'cate_name' => '专题推荐',
                    'description' => '专题推荐',
                    'cate_slug' => 'zttj',
                    'is_nav' => false,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
            ]
        );
    }
}
