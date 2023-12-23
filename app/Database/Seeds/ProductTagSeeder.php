<?php

namespace App\Database\Seeds;

use Ausi\SlugGenerator\SlugGenerator;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductTagSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $productTagsNames = ['Dialog 3G™ 9xx Mhz', 'LoRaWAN OMS', 'ISO 39001', 'Equipment 5G', 'ISO702', 'IoT'];

        $faker         = Factory::create();
        $slugGenerator = new SlugGenerator();

        $productTags = [];

        for ($j = 0; $j < 20; $j++) {
            $ptName        = $faker->randomElement($productTagsNames);
            $productTags[] = [
                'ptName'      => $ptName,
                'ptSlug'      => $slugGenerator->generate($ptName),
                'ptProductId' => $faker->numberBetween(1, 20),
            ];
        }

        $this->db->table('product_tags')->insertBatch($productTags);
    }
}
