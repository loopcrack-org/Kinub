<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $users = [
            [
                'userFirstName' => $faker->name(),
                'userLastName'  => $faker->lastName(),
                'userEmail'     => 'admin@admin.com',
                'userPassword'  => password_hash('fake_password', PASSWORD_BCRYPT),
                'confirmed'     => 1,
                'isAdmin'       => 1,
            ],
            [
                'userFirstName' => $faker->name(),
                'userLastName'  => $faker->lastName(),
                'userEmail'     => 'nkutch@gmail.com',
                'userPassword'  => password_hash('fake_password', PASSWORD_BCRYPT),
                'confirmed'     => 0,
                'isAdmin'       => 0,
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
