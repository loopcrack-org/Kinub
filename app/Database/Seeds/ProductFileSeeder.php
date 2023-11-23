<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductFileSeeder extends Seeder
{
    public function run()
    {
        $productFileTypes = ['image', 'image', 'video', 'product certificate', 'product certificate', 'product certificate', 'datasheet', 'brochure', 'user manual', 'video demo', 'main image'];

        $productFiles = [];

        for ($i = 1; $i < 7; $i++) {
            foreach ($productFileTypes as $productFileType) {
                $productFiles[] = [
                    'pfProductId' => $i,
                    'pfFileId'    => $productFileType === 'video' ? 3 : 1,
                    'pfFileType'  => $productFileType,
                ];
            }
        }

        $this->db->table('product_files')->insertBatch($productFiles);
    }
}
