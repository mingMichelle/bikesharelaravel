<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'zhansan',
                'nickname' => NULL,
                'mobile' => '15940255463',
                'weixin_open_id' => NULL,
                'email' => '99999999@qq.com',
                'gender' => 0,
                'password' => '$2y$10$XODwbxcah/QxEjahi2XC5uS0VPayXds92mOdM9oc2WsIPAcvXRbpO',
                'avatar' => NULL,
                'is_deposit' => 1,
                'deposit_money' => 299,
                'money' => 4091,
                'remember_token' => 'Xk8vZftDDcdDZL4xYx9JBJek1UuDnzRAh44hgmYmtZWLPkwKbT61j8WLk0zs',
                'created_at' => '2019-04-19 07:12:35',
                'updated_at' => '2019-04-20 12:19:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'michelle',
                'nickname' => NULL,
                'mobile' => '15940260379',
                'weixin_open_id' => NULL,
                'email' => 'ming_michelle@qq.com',
                'gender' => 0,
                'password' => '$2y$10$uE24X7YQBYEp1h.EtbjzgeofQ7XeG1NjN1Qc/A2RGgIJ2GMsRHBfO',
                'avatar' => NULL,
                'is_deposit' => 0,
                'deposit_money' => 299,
                'money' => 0,
                'remember_token' => 'jUN08ckPzZTv3bxZ2gXe7CRZClQO70B5Dl7UBrNrdaBDBnS9z5f6BdoSN6cB',
                'created_at' => '2019-04-19 07:23:13',
                'updated_at' => '2019-04-19 07:23:13',
            ),
        ));
        
        
    }
}