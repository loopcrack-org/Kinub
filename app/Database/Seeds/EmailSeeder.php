<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EmailSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $data = [];

        for ($i = 0; $i < 2; $i++) {
            $sampleEmailContent = [
                "nombre" => $faker->name(),
                "telefono" => $faker->phoneNumber(),
                "email" => $faker->email()
            ];
            $data[] = [
                "idTypeEmail" => $faker->numberBetween(1, 2),
                "information" => json_encode($sampleEmailContent)
            ];
        }
        // Using Query Builder
        $this->db->table("emails")->insertBatch($data);
    }
}

?>