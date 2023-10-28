<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'categoryId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'categoryName' => [
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => false,
            ],
            'categoryImageId' => [
                'type' => 'int',
            ],
            'categoryIconId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('categoryId', true);

        $this->forge->addForeignKey('categoryImageId', 'files', 'fileId', 'CASCADE', 'CASCADE', 'category_image_FK');
        $this->forge->addForeignKey('categoryIconId', 'files', 'fileId', 'CASCADE', 'CASCADE', 'category_icon_FK');

        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
