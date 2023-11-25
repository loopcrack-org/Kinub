<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $products = [];

        for ($i = 0; $i < 6; $i++) {
            $products[] = [
                'productName'          => 'Medidor de nivel de radar ' . $faker->randomNumber('2', true) . 'G',
                'productModel'         => 'E-' . $faker->randomNumber('3', true),
                'productDescription'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo debitis, ipsum quae possimus error quasi aspernatur mollitia molestiae expedita! Natus velit non doloribus ea itaque libero at qui possimus aperiam.',
                'productTechnicalInfo' => json_encode([
                    'Frecuencia'            => $faker->randomNumber('3', true) . '300 MHz',
                    'Rango de medición'     => $faker->randomNumber('1', true) . 'km',
                    'Precision de medición' => $faker->randomNumber('2', true) . '%',
                    'Potencia'              => $faker->randomNumber('3', true) . ' MW',
                    'Comunicación'          => $faker->randomElements(['5G Ipv6', '3G', 'WPAN', 'WPA2']),
                ]),
                'productCategoryId' => $faker->numberBetween(1, 2),
            ];
        }

        $this->db->table('products')->insertBatch($products);
    }
}
