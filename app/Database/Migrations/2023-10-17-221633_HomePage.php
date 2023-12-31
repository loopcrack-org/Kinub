<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HomePage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'homePageId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'aboutUsText' => [
                'type' => 'text',
            ],
            'aboutUsImageId' => [
                'type' => 'int',
            ],
            'aboutUsVideoId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('homePageId', true);

        $this->forge->addForeignKey('aboutUsImageId', 'files', 'fileId', 'NO ACTION', 'NO ACTION', 'about_us_image_FK');
        $this->forge->addForeignKey('aboutUsVideoId', 'files', 'fileId', 'NO ACTION', 'NO ACTION', 'about_us_video_FK');

        $this->forge->createTable('home_page');
    }

    public function down()
    {
        $this->forge->dropTable('home_page');
    }
}
