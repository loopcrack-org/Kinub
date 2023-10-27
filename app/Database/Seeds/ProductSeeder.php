<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product = [
            'productName'          => 'Medidor de nivel de radar 80G',
            'productModel'         => 'E-101',
            'productDescription'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo debitis, ipsum quae possimus error quasi aspernatur mollitia molestiae expedita! Natus velit non doloribus ea itaque libero at qui possimus aperiam.',
            'productTechnicalInfo' => json_encode([
                'Frecuencia'            => ' 300 MHz',
                'Rango de medición'     => '5km',
                'Precision de medicion' => '90%',
                'Potencia'              => '500 MW',
                'Comunicacion'          => '5G Ipv6',
            ]),
            'productDemoVideoId' => 3,
            'productCategoryId'  => 2,
        ];

        $this->db->table('products')->insert($product);
    }
}
