<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserTokensSeeder extends Seeder
{
    public function run()
    {
        $token = [
            'userToken'       => 'FAS12AQajqa',
            'tokenExpiryDate' => date('y-m-d', strtotime(' +1 day')),
            'userId'          => 2,
        ];

        $this->db->table('user_tokens')->insert($token);
    }
}
