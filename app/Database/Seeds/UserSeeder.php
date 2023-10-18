<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $data  = [
            [
                'userFirstName' => $faker->name(),
                'userLastName'  => $faker->lastName(),
                'userEmail'     => 'admin@admin.com',
                'userPassword'  => password_hash('fake_password', PASSWORD_BCRYPT),
                'userToken'     => 'FAS12AQajqa',
                'isConfirmed'   => 1,
                'isAdmin'       => 1,
            ],
            [
                'userFirstName' => $faker->name(),
                'userLastName'  => $faker->lastName(),
                'userEmail'     => 'nkutch@gmail.com',
                'userPassword'  => password_hash('fake_password', PASSWORD_BCRYPT),
                'userToken'     => 'FAS12AQajqa',
                'isConfirmed'   => 0,
                'isAdmin'       => 0,
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
