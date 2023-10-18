<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsTags extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ptId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'ptName' => [
                'type'       => 'varchar',
                'constraint' => 45,
            ],
            'ptProductId' => [
                'type' => 'int',
            ],
        ]);
        $this->forge->addKey('ptId', true);

        $this->forge->addForeignKey('ptProductId', 'products', 'productId');

        $this->forge->createTable('product_tags');
    }

    public function down()
    {
        $this->forge->dropTable('product_tags');
    }
}
