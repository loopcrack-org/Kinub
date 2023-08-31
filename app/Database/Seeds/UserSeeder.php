<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder{
    public function run(){
        $faker = Factory::create();
        $data = [
            "name" => $faker->name(),
            "lastName" => $faker->lastName(),
            "email"=>$faker->email(),
            "password"=> password_hash("fake_password", PASSWORD_BCRYPT),
            "token"=> "FrIDLkk60SIde",
            "confirm"=> 0,
            "admin" => 0
        ];


        // Using Query Builder
        $this->db->table("User")->insert($data);
    }
}

