<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        $homePageData = [[
            'aboutUsText'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolor itaque sit nesciunt nihil maiores placeat sequi recusandae earum voluptatibus accusantium modi natus dolorem, tenetur, quod reprehenderit nostrum. Error, sit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, illum saepe ab, sit iure dignissimos',
            'aboutUsImageId' => 1,
            'aboutUsVideoId' => 3,
        ]];

        $this->db->table('home_page')->insertBatch($homePageData);
    }
}
