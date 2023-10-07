<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "categoryName" => "Software",
                "categoryImageId" => 1,
                "categoryIconId" => 2,
            ],
            [
                "categoryName" => "Telemetría",
                "categoryImageId" => 1,
                "categoryIconId" => 2,
            ]
        ];

        $this->db->table("categories")->insertBatch($data);
    }
}