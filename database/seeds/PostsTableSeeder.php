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
                'author' => 1,
                'title' => 'hello world',
                'slug' => 'hello-world',
                'content' => '这是第一篇文章',
                'status' => 'publish',
                'type' => 'post',
                'top' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'author' => 1,
                'title' => 'hello world111111',
                'slug' => 'hello-world111111111',
                'content' => '这是第二篇文章11111111',
                'status' => 'publish',
                'type' => 'post',
                'top' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
