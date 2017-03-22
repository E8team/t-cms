<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'id'=>1,
                'name' => '默认分类',
                'description' => '默认分类',
                'typeable_type' => \App\Entities\Link::class
            ],
            [
                'id'=>2,
                'name' => '搜索引擎',
                'description' => '最大的中文搜索引擎',
                'typeable_type' => \App\Entities\Link::class
            ],
        ]);
    }
}
