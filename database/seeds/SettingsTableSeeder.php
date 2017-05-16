<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'name' => 'web_name',
                'value' => 't-cms',
                'description' => '',
                'is_autoload' => true,
                'type_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'icp_num',
                'value' => '京ICP备0000001号',
                'description' => '',
                'is_autoload' => false,
                'type_id' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
