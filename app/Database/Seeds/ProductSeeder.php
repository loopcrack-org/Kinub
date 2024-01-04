<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker           = Factory::create();
        $totalProducts   = 20;
        $totalCategories = (new CategoryModel())->countAllResults();
        $products        = [];

        for ($i = 0; $i < $totalProducts; $i++) {
            $products[] = [
                'productName'          => 'Medidor de nivel de radar ' . $faker->randomNumber('2', true) . 'G',
                'productModel'         => 'E-' . $faker->randomNumber('3', true),
                'productDescription'   => '<h2>Producto de software</h2><p>El mejor producto en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>',
                'productDetails'       => '<h2>Producto de software</h2><p>El mejor producto en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>',
                'productTechnicalInfo' => json_encode([
                    'Frecuencia'            => $faker->randomNumber('3', true) . '300 MHz',
                    'Rango de medición'     => $faker->randomNumber('1', true) . 'km',
                    'Precision de medición' => $faker->randomNumber('2', true) . '%',
                    'Potencia'              => $faker->randomNumber('3', true) . ' MW',
                    'Comunicación'          => $faker->randomElement(['5G Ipv6', '3G', 'WPAN', 'WPA2']),
                ]),
                'productCategoryId' => $faker->numberBetween(1, $totalCategories),
            ];
        }

        $this->db->table('products')->insertBatch($products);
    }
}
