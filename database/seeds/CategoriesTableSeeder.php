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
        DB::table('categories')->insert([
            [
                'id' => 1,
                'type' => 0,
                'cate_name' => '公司新闻',
                'description' => '这里的公司新闻',
                'cate_slug' => 'company-news',
                'is_nav' => true,
                'parent_id' => 0,
                'list_template' => 'list',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'type' => 1,
                'cate_name' => '公司概况',
                'description' => '公司概况',
                'cate_slug' => 'company-gk',
                'is_nav' => true,
                'parent_id' => 0,
                'list_template' => 'list',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'type' => 1,
                'cate_name' => '公司简介',
                'description' => '公司简介',
                'cate_slug' => 'company-jj',
                'is_nav' => true,
                'parent_id' => 2,
                'list_template' => 'list',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 4,
                'type' => 1,
                'cate_name' => '现任领导',
                'description' => '现任领导',
                'cate_slug' => 'company-xrld',
                'is_nav' => true,
                'parent_id' => 2,
                'list_template' => 'list',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 5,
                'type' => 0,
                'cate_name' => '公司新闻123',
                'description' => '这里的公司新闻123',
                'cate_slug' => 'company-news123',
                'is_nav' => true,
                'parent_id' => 1,
                'list_template' => 'list',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
