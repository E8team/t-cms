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
        DB::table('links')->insert([
            [
                'id' => 1,
                'url' => 'https://www.3twd.cn',
                'linkman' => '3t',
                'type_id' => 1,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'url' => 'https://www.baidu.com',
                'linkman' => '李总',
                'type_id' => 2,
                'is_visible' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
