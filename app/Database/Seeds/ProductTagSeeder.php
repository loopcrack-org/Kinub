<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductTagSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $productTagsNames = ['Dialog 3G™ 9xx Mhz', 'LoRaWAN OMS', 'ISO 39001'];

        $productTags = [];

        for ($i = 1; $i < 7; $i++) {
            $productTagsNames = $faker->randomElements($productTagsNames, 2);
            $productTags[]    = [
                'ptName'      => $productTagsNames[0],
                'ptProductId' => $i,
            ];
            $productTags[] = [
                'ptName'      => $productTagsNames[1],
                'ptProductId' => $i,
            ];
        }

        $this->db->table('product_tags')->insertBatch($productTags);
    }
}
