<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoryTags extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'categoryTagId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'categoryTagName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'categoryId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('categoryTagId', true);

        $this->forge->addForeignKey('categoryId', 'categories', 'categoryId');

        $this->forge->createTable('category_tags');
    }

    public function down()
    {
        $this->forge->dropTable('category_tags');
    }
}
