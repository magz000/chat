<?php

use Illuminate\Database\Seeder;

class GroupSystemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_systems')->delete();
        
        \DB::table('group_systems')->insert(array (
            0 => 
            array (
                'id' => 1,
                'group_id' => 1,
                'system_id' => 1,
                'status' => 1,
                'created_at' => '2018-11-09 10:28:27',
                'updated_at' => '2018-11-09 10:28:27',
            ),
            1 => 
            array (
                'id' => 2,
                'group_id' => 1,
                'system_id' => 2,
                'status' => 1,
                'created_at' => '2018-11-09 10:28:27',
                'updated_at' => '2018-11-09 10:28:27',
            ),
        ));
        
        
    }
}