<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    public function run()
    {
        $productTags = [
            [
                'ptName'      => 'Dialog 3G™ 9xx Mhz',
                'ptProductId' => 1,
            ],
            [
                'ptName'      => 'LoRaWAN OMS',
                'ptProductId' => 1,
            ],
        ];

        $this->db->table('product_tags')->insertBatch($productTags);
    }
}
