<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductFileSeeder extends Seeder
{
    public function run()
    {
        $productFileTypes = ['image', 'image', 'video', 'product certificate', 'product certificate', 'product certificate', 'datasheet', 'brochure', 'user manual'];

        $productFiles = [];

        foreach ($productFileTypes as $productFileType) {
            $productFiles[] = [
                'pfProductId' => 1,
                'pfFileId'    => 1,
                'pfFileType'  => $productFileType,
            ];
        }

        $this->db->table('product_files')->insertBatch($productFiles);
    }
}
