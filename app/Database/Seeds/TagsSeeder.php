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
                "categoryId" => 1,
            ],
            [
                "name" => "Tag2",
                "categoryId" => 1,
            ],
            [
                "name" => "Tag3",
                "categoryId" => 2,
            ],
            [
                "name" => "Tag4",
                "categoryId" => 2,
            ]
        ];

        // Using Query Builder
        $this->db->table("Tags")->insertBatch($data);
    }
}