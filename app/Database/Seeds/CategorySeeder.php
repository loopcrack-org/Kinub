<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name" => "Software",
                "image" => md5(uniqid(rand(), true)),
                "icon" => md5(uniqid(rand(), true)),
            ],
            [
                "name" => "Telemetría",
                "image" => md5(uniqid(rand(), true)),
                "icon" => md5(uniqid(rand(), true)),
            ]
        ];


        // Using Query Builder
        $this->db->table("Category")->insertBatch($data);
    }
}