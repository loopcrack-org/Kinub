<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoryTagSeeder extends Seeder
{
    public function run()
    {
        $categories = $this->db->query('SELECT * FROM categories')->getResultArray();

        $categoryTags = [];

        foreach ($categories as $category) {
            for ($i = 1; $i < 3; $i++) {
                $categoryTags[] = [
                    'categoryTagName' => 'Tag ' . $category['categoryName'] . $i,
                    'categoryId'      => $category['categoryId'],
                ];
            }
        }

        $this->db->table('category_tags')->insertBatch($categoryTags);
    }
}
