<?php

use Illuminate\Database\Seeder;

class CachePagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cache_pages')->insert(
            [
                [
                    'id' => 1,
                    'route_name' => 'index',
                    'description' => '首页缓存',
                    'is_cache_forever' => true,
                    'cache_time' => 0,
                    'order' => 0,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            ]
        );
    }
}
