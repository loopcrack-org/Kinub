<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategoryTagSeeder extends Seeder
{
    public function run()
    {
        $productCategoryTags = [
            [
                'pctProductId'     => 1,
                'pctCategoryTagId' => 3,
            ],
            [
                'pctProductId'     => 1,
                'pctCategoryTagId' => 4,
            ],
        ];

        $this->db->table('products-category_tags')->insertBatch($productCategoryTags);
    }
}
