<?php

namespace App\Database\Seeds;

// use Ausi\SlugGenerator\SlugGenerator;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // $slugGenerator     = new SlugGenerator();
        $allowedCategories = ['Software', 'Telemetría', 'Combustible', 'Distribución de Agua', 'Control de procesos hidráulicos', 'Tratamiento de agua y aguas residuales'];
        $categories        = [];

        foreach ($allowedCategories as $category) {
            $categories[] = [
                'categoryName' => $category,
                // 'categorySlug'    => $slugGenerator->generate($category),
                'categoryImageId' => 1,
                'categoryIconId'  => 2,
            ];
        }

        $this->db->table('categories')->insertBatch($categories);
    }
}
