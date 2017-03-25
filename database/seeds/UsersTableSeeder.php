<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'user_name' => 'ty666',
            'nick_name' => '陶煜',
            'email' => 'taoyu@qq.com',
            'password' => bcrypt('taoyu'),
            'is_lock' => false,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
