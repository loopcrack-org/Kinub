<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'productId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'productName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'productModel' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'productDescription' => [
                'type' => 'text',
            ],
            'productTechnicalInfo' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'productCategoryId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('productId', true);

        $this->forge->addForeignKey('productCategoryId', 'categories', 'categoryId', 'CASCADE', 'CASCADE', 'product_category_FK');

        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
