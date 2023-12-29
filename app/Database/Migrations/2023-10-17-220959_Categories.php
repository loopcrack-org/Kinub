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
            ],
            'categorySubname' => [
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => true,
            ],
            'categorySlug' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'categoryImageId' => [
                'type' => 'int',
                'null' => true,
            ],
            'categoryIconId' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('categoryId', true);

        $this->forge->addForeignKey('categoryImageId', 'files', 'fileId', 'SET NULL', 'SET NULL', 'category_image_FK');
        $this->forge->addForeignKey('categoryIconId', 'files', 'fileId', 'SET NULL', 'SET NULL', 'category_icon_FK');

        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
