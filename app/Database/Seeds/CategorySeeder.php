<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $faker      = Factory::create();
        $categories = [
            [
                'categoryName'    => 'Software',
                'categoryImageId' => 2,
                'categoryIconId'  => 2,
            ],
            [
                'categoryName'    => 'Telemetría',
                'categoryImageId' => 1,
                'categoryIconId'  => 2,
            ],
            [
                'categoryName'    => 'Combustible',
                'categoryImageId' => 3,
                'categoryIconId'  => 2,
            ],
            [
                'categoryName'    => 'Distribución Agua',
                'categoryImageId' => 1,
                'categoryIconId'  => 2,
            ],
            [
                'categoryName'    => 'Control de procesos hidráulicos',
                'categoryImageId' => 3,
                'categoryIconId'  => 2,
            ],
            [
                'categoryName'    => 'Tratamiento de agua y aguas residuales',
                'categoryImageId' => 2,
                'categoryIconId'  => 2,
            ],
        ];

        $this->db->table('categories')->insertBatch($categories);
    }
}
