<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CategoryTagSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $data = [
            [
                "categoryTagName" => "Tag1",
                "categoryId" => $faker->numberBetween(1, 3),
            ],
            [
                "categoryTagName" => "Tag2",
                "categoryId" => $faker->numberBetween(1, 3),
            ],
            [
                "categoryTagName" => "Tag3",
                "categoryId" => $faker->numberBetween(1, 3),
            ],
            [
                "categoryTagName" => "Tag4",
                "categoryId" => $faker->numberBetween(1, 3),
            ]
        ];

        // Using Query Builder
        $this->db->table("category_tags")->insertBatch($data);
    }
}