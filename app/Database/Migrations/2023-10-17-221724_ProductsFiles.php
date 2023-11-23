<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsFiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pfId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'pfProductId' => [
                'type' => 'int',
            ],
            'pfFileId' => [
                'type' => 'int',
            ],
            'pfFileType' => [
                'type' => "enum('image','video','product certificate','datasheet','brochure','user manual', 'video demo', 'main image')",
            ],
        ]);

        $this->forge->addKey('pfId', true);

        $this->forge->addForeignKey('pfProductId', 'products', 'productId', 'CASCADE', 'CASCADE', 'pf_product_FK');
        $this->forge->addForeignKey('pfFileId', 'files', 'fileId', 'CASCADE', 'CASCADE', 'pf_file_FK');

        $this->forge->createTable('product_files');
    }

    public function down()
    {
        $this->forge->dropTable('product_files');
    }
}
