<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategoryTagSeeder extends Seeder
{
    public function run()
    {
        $products = $this->db->query('SELECT * FROM products');
        $products = $products->getResultArray();

        $productCategoryTags = [];

        foreach ($products as $product) {
            $categoryTagsIds = $this->db->query('SELECT categoryTagId FROM category_tags WHERE categoryId=\'' . $product['productCategoryId'] . '\'')->getResultArray();

            for ($i = 0; $i < 2; $i++) {
                $productCategoryTags[] = [
                    'pctProductId'     => $product['productId'],
                    'pctCategoryTagId' => $categoryTagsIds[$i]['categoryTagId'],
                ];
            }
        }

        $this->db->table('products-category_tags')->insertBatch($productCategoryTags);
    }
}
