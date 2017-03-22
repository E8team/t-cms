<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'id' => 1,
                'post_author' => 1,
                'post_title' => 'hello world',
                'post_slug' => 'hello-world',
                'post_content' => '这是第一篇文章',
                'post_status' => 'publish',
                'post_type' => 'post',
                'top' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'post_author' => 1,
                'post_title' => 'hello world111111',
                'post_slug' => 'hello-world111111111',
                'post_content' => '这是第二篇文章11111111',
                'post_status' => 'publish',
                'post_type' => 'post',
                'top' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
