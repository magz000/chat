<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admins')->delete();

        \DB::table('admins')->insert(array (
            0 =>
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$c5V8XGSXWDQzUImpRHhoD.AbJVBP1d3YwfEooE6r/3TexYS9VKMmq',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-07 11:52:44',
                'updated_at' => '2018-11-09 14:12:24',
            ),
            1 =>
            array (
                'id' => 2,
                'username' => 'admin2',
                'password' => '$2y$10$lUCLLg2W5BLffCykE.xdauctTnl2dwimqPYABocaTPnuw0FYYx7VK',
                'first_name' => 'Admin',
                'last_name' => 'User 2',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-09 14:06:14',
                'updated_at' => '2018-11-09 14:06:14',
            ),
        ));


    }
}
