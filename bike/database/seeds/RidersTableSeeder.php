<?php

use Illuminate\Database\Seeder;

class RidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riders')->delete();
        
        \DB::table('riders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 07:46:32',
                'end_at' => '2019-04-20 08:06:56',
                'money' => 1,
                'is_pay' => 1,
                'created_at' => '2019-04-20 07:46:32',
                'updated_at' => '2019-04-20 08:06:56',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 08:08:13',
                'end_at' => '2019-04-20 08:08:24',
                'money' => 0,
                'is_pay' => 1,
                'created_at' => '2019-04-20 08:08:13',
                'updated_at' => '2019-04-20 08:08:24',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 08:10:40',
                'end_at' => '2019-04-20 08:10:52',
                'money' => 0,
                'is_pay' => 1,
                'created_at' => '2019-04-20 08:10:40',
                'updated_at' => '2019-04-20 08:10:52',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 08:11:53',
                'end_at' => '2019-04-20 08:12:02',
                'money' => 0,
                'is_pay' => 1,
                'created_at' => '2019-04-20 08:11:53',
                'updated_at' => '2019-04-20 08:12:02',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 08:17:24',
                'end_at' => '2019-04-20 08:17:34',
                'money' => 0,
                'is_pay' => 1,
                'created_at' => '2019-04-20 08:17:24',
                'updated_at' => '2019-04-20 08:17:34',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'bike_id' => 1,
                'start_at' => '2019-04-20 08:28:23',
                'end_at' => '2019-04-20 12:19:41',
                'money' => 8,
                'is_pay' => 1,
                'created_at' => '2019-04-20 08:28:23',
                'updated_at' => '2019-04-20 12:19:41',
            ),
        ));
        
        
    }
}