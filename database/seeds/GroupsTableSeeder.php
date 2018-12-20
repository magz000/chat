<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('groups')->delete();

        \DB::table('groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'DCP_RDMS',
                'status' => 1,
                'created_at' => '2018-11-09 10:28:27',
                'updated_at' => '2018-11-09 11:17:39',
            ),
        ));


    }
}
