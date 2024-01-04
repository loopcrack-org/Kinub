<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FileSeeder extends Seeder
{
    public function run()
    {
        $files = [
            [
                'fileRoute'          => '/assets/images/auth-one-bg.jpg',
                'uuid'               => '79c4387d-c1cb-4e6f-b418-8c391d852e2c',
                'fileName'           => 'auth-one-bg.jpg',
                'fileDirectoryRoute' => '/assets/images/',
            ],
            [
                'fileRoute'          => '/assets/images/auth-two-bg.jpg',
                'uuid'               => '79c4387d-c1cb-4e6f-b418-8c391d852e2c',
                'fileName'           => 'auth-one-bg.jpg',
                'fileDirectoryRoute' => '/assets/images/',
            ],
            [
                'fileRoute'          => '/assets/images/auth-three-bg.jpg',
                'uuid'               => '79c4387d-c1cb-4e6f-b418-8c391d852e2c',
                'fileName'           => 'auth-one-bg.jpg',
                'fileDirectoryRoute' => '/assets/images/',
            ],
            [
                'fileRoute'          => '/assets/images/drop.svg',
                'uuid'               => '9d7b76e0-a31f-4e0f-9ac6-b71bc35f2ed4',
                'fileName'           => 'drop.svg',
                'fileDirectoryRoute' => '/assets/images/',
            ],
            [
                'fileRoute'          => '/assets/video/kinub-video-example.mp4',
                'uuid'               => '8303bd6a-0b6b-43ea-ac23-31e02a64ba82',
                'fileName'           => 'kinub-video-example.mp4',
                'fileDirectoryRoute' => '/assets/video/',
            ],
        ];

        $this->db->table('files')->insertBatch($files);
    }
}
