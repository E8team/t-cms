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
            'user_name' => 'ty666',
            'email' => 'taoyu@qq.com',
            'password' => bcrypt('taoyu'),
            'reg_ip' => '8.8.8.8',
            'last_ip' => '8.8.8.8',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
