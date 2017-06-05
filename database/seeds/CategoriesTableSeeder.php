<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                    'type' => 1,
                    'cate_name' => '学院概况',
                    'description' => '学院概况',
                    'cate_slug' => 'department-profile',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'page_template' => 'post.page',
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 2,
                    'type' => 0,
                    'cate_name' => '教育教学',
                    'description' => '教育教学',
                    'cate_slug' => 'education-teach',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 3,
                    'type' => 0,
                    'cate_name' => '学科建设',
                    'description' => '学科建设',
                    'cate_slug' => 'discipline-construction',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 4,
                    'type' => 0,
                    'cate_name' => '党建工作',
                    'description' => '党建工作',
                    'cate_slug' => 'party-construction',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 5,
                    'type' => 0,
                    'cate_name' => '团学工作',
                    'description' => '团学工作',
                    'cate_slug' => 'league-work',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 6,
                    'type' => 0,
                    'cate_name' => '招生就业',
                    'description' => '招生就业',
                    'cate_slug' => 'enrollment-and-employment',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 7,
                    'type' => 0,
                    'cate_name' => '信息公开',
                    'description' => '信息公开',
                    'cate_slug' => 'information-publicity',
                    'is_nav' => true,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
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
                    'content_template' => 'post.content',
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
                    'content_template' => 'post.content',
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
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 11,
                    'type' => 1,
                    'cate_name' => '机构设置',
                    'description' => '机构设置',
                    'cate_slug' => 'organization-setting',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'page_template' => 'post.page',
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 12,
                    'type' => 1,
                    'cate_name' => '教学系部',
                    'description' => '教学系部',
                    'cate_slug' => 'department-of-teaching',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'page_template' => 'post.page',
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 13,
                    'type' => 1,
                    'cate_name' => '实验中心',
                    'description' => '实验中心',
                    'cate_slug' => 'experimental-center',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'page_template' => 'post.page',
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 14,
                    'type' => 1,
                    'cate_name' => '专业介绍',
                    'description' => '专业介绍',
                    'cate_slug' => 'professional-introduction',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'page_template' => 'post.page',
                    'content_template' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 15,
                    'type' => 0,
                    'cate_name' => '师资队伍',
                    'description' => '师资队伍',
                    'cate_slug' => 'teaching-staff',
                    'is_nav' => true,
                    'parent_id' => 1,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 16,
                    'type' => 0,
                    'cate_name' => '共青团工作',
                    'description' => '共青团工作',
                    'cate_slug' => 'Communist-youth-league-work',
                    'is_nav' => true,
                    'parent_id' => 5,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 17,
                    'type' => 0,
                    'cate_name' => '学生工作',
                    'description' => '学生工作',
                    'cate_slug' => 'student-work',
                    'is_nav' => true,
                    'parent_id' => 5,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 18,
                    'type' => 0,
                    'cate_name' => '优秀事迹',
                    'description' => '优秀事迹',
                    'cate_slug' => 'excellent-deeds',
                    'is_nav' => true,
                    'parent_id' => 5,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 19,
                    'type' => 0,
                    'cate_name' => '招生计划',
                    'description' => '招生计划',
                    'cate_slug' => 'enrollment-plan',
                    'is_nav' => true,
                    'parent_id' => 5,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 20,
                    'type' => 0,
                    'cate_name' => '就业工程',
                    'description' => '就业工程',
                    'cate_slug' => 'employment-project',
                    'is_nav' => true,
                    'parent_id' => 5,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 21,
                    'type' => 0,
                    'cate_name' => '政务公开',
                    'description' => '政务公开',
                    'cate_slug' => 'openness-of-government-affairs',
                    'is_nav' => true,
                    'parent_id' => 7,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 22,
                    'type' => 0,
                    'cate_name' => '党务公开',
                    'description' => '党务公开',
                    'cate_slug' => 'party-affairs-publicity',
                    'is_nav' => true,
                    'parent_id' => 7,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 23,
                    'type' => 0,
                    'cate_name' => '专题推荐',
                    'description' => '专题推荐',
                    'cate_slug' => 'special-recommendation',
                    'is_nav' => false,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 24,
                    'type' => 0,
                    'cate_name' => '通知公告',
                    'description' => '通知公告',
                    'cate_slug' => 'notice',
                    'is_nav' => false,
                    'parent_id' => 0,
                    'list_template' => 'post.list',
                    'content_template' => 'post.content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            ]
        );
    }
}
