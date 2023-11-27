<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsCategoryTags extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pctId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'pctProductId' => [
                'type' => 'int',
            ],
            'pctCategoryTagId' => [
                'type' => 'int',
            ],
        ]);
        $this->forge->addKey('pctId', true);

        $this->forge->addForeignKey('pctProductId', 'products', 'productId', 'NO ACTION', 'NO ACTION', 'pct_product_FK');
        $this->forge->addForeignKey('pctCategoryTagId', 'category_tags', 'categoryTagId', 'NO ACTION', 'NO ACTION', 'pct_categoryTag_FK');

        $this->forge->createTable('products-category_tags');
    }

    public function down()
    {
        $this->forge->dropTable('products-category_tags');
    }
}
