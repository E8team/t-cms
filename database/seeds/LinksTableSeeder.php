<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert(
            [
            [
                'id' => 1,
                'name' => '3t官网',
                'url' => 'https://www.3twd.cn',
                'linkman' => '3t',
                'type_id' => 1,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'name' => '百度官网',
                'url' => 'https://www.baidu.com',
                'linkman' => '李总',
                'type_id' => 2,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 3,
                'name' => '淘宝网',
                'url' => 'http://www.taobao.com',
                'linkman' => 'ty',
                'type_id' => null,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 4,
                'name' => '新浪',
                'url' => 'https://www.sina.com',
                'linkman' => 'ty',
                'type_id' => null,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
            ]
        );
    }
}
