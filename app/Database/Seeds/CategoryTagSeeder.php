<?php

namespace App\Database\Seeds;

use Ausi\SlugGenerator\SlugGenerator;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CategoryTagSeeder extends Seeder
{
    public function run()
    {
        $categories = $this->db->query('SELECT * FROM categories')->getResultArray();

        $categoryTags  = [];
        $faker         = Factory::create();
        $slugGenerator = new SlugGenerator();

        foreach ($categories as $category) {
            for ($i = 1; $i < 3; $i++) {
                $categoryTagName = $faker->words(3, true);
                $categoryTags[]  = [
                    'categoryTagName' => $categoryTagName,
                    'categoryTagSlug' => $slugGenerator->generate($categoryTagName),
                    'categoryId'      => $category['categoryId'],
                ];
            }
        }

        $this->db->table('category_tags')->insertBatch($categoryTags);
    }
}
