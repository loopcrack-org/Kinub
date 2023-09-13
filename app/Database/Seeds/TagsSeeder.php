<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TagsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name" => "Tag1",
                "idCategory" => 1,
            ],
            [
                "name" => "Tag2",
                "idCategory" => 1,
            ],
            [
                "name" => "Tag3",
                "idCategory" => 2,
            ],
            [
                "name" => "Tag4",
                "idCategory" => 2,
            ]
        ];

        // Using Query Builder
        $this->db->table("tags")->insertBatch($data);
    }
}