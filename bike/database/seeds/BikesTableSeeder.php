<?php

use Illuminate\Database\Seeder;

class BikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bikes')->delete();
        
        \DB::table('bikes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lng' => 118.168066,
                'lat' => 24.533111,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:53:28',
                'updated_at' => '2019-04-20 12:19:41',
            ),
            1 => 
            array (
                'id' => 2,
                'lng' => 118.167526,
                'lat' => 24.5332,
                'is_riding' => 1,
                'created_at' => '2017-05-24 10:53:44',
                'updated_at' => '2017-06-12 08:14:11',
            ),
            2 => 
            array (
                'id' => 3,
                'lng' => 118.168246,
                'lat' => 24.53329,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:54:36',
                'updated_at' => '2017-05-24 10:54:36',
            ),
            3 => 
            array (
                'id' => 4,
                'lng' => 118.168696,
                'lat' => 24.532841,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:54:44',
                'updated_at' => '2017-05-24 10:54:44',
            ),
            4 => 
            array (
                'id' => 5,
                'lng' => 118.168156,
                'lat' => 24.53374,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:54:53',
                'updated_at' => '2017-05-24 10:54:53',
            ),
            5 => 
            array (
                'id' => 6,
                'lng' => 118.168066,
                'lat' => 24.532751,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:54:55',
                'updated_at' => '2017-05-24 10:54:55',
            ),
            6 => 
            array (
                'id' => 7,
                'lng' => 118.168516,
                'lat' => 24.53365,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:54:57',
                'updated_at' => '2017-05-24 10:54:57',
            ),
            7 => 
            array (
                'id' => 8,
                'lng' => 118.168786,
                'lat' => 24.532841,
                'is_riding' => 0,
                'created_at' => '2017-05-24 10:58:50',
                'updated_at' => '2017-05-24 10:58:50',
            ),
            8 => 
            array (
                'id' => 9,
                'lng' => 112.11038,
                'lat' => 24.11047,
                'is_riding' => 0,
                'created_at' => '2017-06-10 14:27:07',
                'updated_at' => '2017-06-10 14:27:07',
            ),
            9 => 
            array (
                'id' => 10,
                'lng' => 112.11182,
                'lat' => 24.11074,
                'is_riding' => 0,
                'created_at' => '2017-06-10 14:27:30',
                'updated_at' => '2017-06-10 14:27:30',
            ),
            10 => 
            array (
                'id' => 11,
                'lng' => 112.11056,
                'lat' => 24.11155,
                'is_riding' => 0,
                'created_at' => '2019-04-20 06:39:57',
                'updated_at' => '2019-04-20 06:39:57',
            ),
            11 => 
            array (
                'id' => 12,
                'lng' => 112.11155,
                'lat' => 24.11164,
                'is_riding' => 0,
                'created_at' => '2019-04-20 06:41:40',
                'updated_at' => '2019-04-20 06:41:40',
            ),
            12 => 
            array (
                'id' => 13,
                'lng' => 112.11146,
                'lat' => 24.11029,
                'is_riding' => 0,
                'created_at' => '2019-04-20 07:19:22',
                'updated_at' => '2019-04-20 07:19:22',
            ),
            13 => 
            array (
                'id' => 14,
                'lng' => 112.11092,
                'lat' => 24.11038,
                'is_riding' => 0,
                'created_at' => '2019-04-20 07:34:38',
                'updated_at' => '2019-04-20 07:34:38',
            ),
            14 => 
            array (
                'id' => 15,
                'lng' => 112.11155,
                'lat' => 24.11119,
                'is_riding' => 0,
                'created_at' => '2019-04-20 12:33:18',
                'updated_at' => '2019-04-20 12:33:18',
            ),
            15 => 
            array (
                'id' => 16,
                'lng' => 118.11065,
                'lat' => 24.11065,
                'is_riding' => 0,
                'created_at' => '2019-04-20 12:33:59',
                'updated_at' => '2019-04-20 12:33:59',
            ),
        ));
        
        
    }
}