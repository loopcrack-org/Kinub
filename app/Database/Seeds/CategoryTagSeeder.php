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
                "categoryId" => $faker->numberBetween(1, 2),
            ],
            [
                "categoryTagName" => "Tag2",
                "categoryId" => $faker->numberBetween(1, 2),
            ],
            [
                "categoryTagName" => "Tag3",
                "categoryId" => $faker->numberBetween(1, 2),
            ],
            [
                "categoryTagName" => "Tag4",
                "categoryId" => $faker->numberBetween(1, 2),
            ]
        ];

        // Using Query Builder
        $this->db->table("category_tags")->insertBatch($data);
    }
}