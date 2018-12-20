<?php

use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('systems')->delete();
        
        \DB::table('systems')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'DCP',
                'status' => 1,
                'created_at' => '2018-11-09 10:28:01',
                'updated_at' => '2018-11-09 10:28:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'RDMS',
                'status' => 1,
                'created_at' => '2018-11-09 10:28:05',
                'updated_at' => '2018-11-09 10:28:05',
            ),
        ));
        
        
    }
}