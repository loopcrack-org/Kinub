<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder{
    public function run(){
        $faker = Factory::create();
        $data = [
            [
                "name" => $faker->name(),
                "lastName" => $faker->lastName(),
                "email"=> "admin@admin.com",
                "password"=> password_hash("fake_password", PASSWORD_BCRYPT),
                "token"=> "",
                "confirm"=> 0,
                "admin" => 1
            ], 
            [ 
                "name" => $faker->name(),
                "lastName" => $faker->lastName(),
                "email"=> "nkutch@gmail.com",
                "password"=> password_hash("fake_password", PASSWORD_BCRYPT),
                "token"=> "",
                "confirm"=> 0,
                "admin" => 0  
            ]
        ];


        // Using Query Builder
        $this->db->table("User")->insertBatch($data);
    }
}

