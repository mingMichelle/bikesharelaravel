<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'K9zbxBpGD3YvcEyC5Y9vQFC9CIo8ljBU7GuXlqdy',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2019-04-22 12:24:01',
                'updated_at' => '2019-04-22 12:24:01',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'skXZ6PcAdU0VqLlQSn9GGkk5vr43FiSxSmdDtqgD',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2019-04-22 12:24:01',
                'updated_at' => '2019-04-22 12:24:01',
            ),
        ));
        
        
    }
}