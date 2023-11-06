<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoryTagSeeder extends Seeder
{
    public function run()
    {
        $categoriesTags = [
            [
                'categoryTagName' => 'Tag1',
                'categoryId'      => 1,
            ],
            [
                'categoryTagName' => 'Tag2',
                'categoryId'      => 1,
            ],
            [
                'categoryTagName' => 'Tag3',
                'categoryId'      => 2,
            ],
            [
                'categoryTagName' => 'Tag4',
                'categoryId'      => 2,
            ],
        ];

        $this->db->table('category_tags')->insertBatch($categoriesTags);
    }
}
