<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HomePage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'homePageId' => [
                'type' => 'int',
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

        $this->forge->addForeignKey('aboutUsImageId', 'files', 'fileId');
        $this->forge->addForeignKey('aboutUsVideoId', 'files', 'fileId');

        $this->forge->createTable('home_page');
    }

    public function down()
    {
        $this->forge->dropTable('home_page');
    }
}
