<?php

namespace App\Database\Migrations;

namespace Kinub\Files;

use CodeIgniter\Database\Migration;

class Files extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'fileId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'fileRoute' => [
                'type'       => 'varchar',
                'constraint' => 255,
            ],
            'uuid' => [
                'type'       => 'varchar',
                'constraint' => 36,
            ],
            'fileName' => [
                'type'       => 'varchar',
                'constraint' => 45,
            ],
            'fileDirectoryRoute' => [
                'type'       => 'varchar',
                'constraint' => 150,
            ],
        ]);

        $this->forge->addKey('fileId', true);

        $this->forge->createTable('files');
    }

    public function down()
    {
    }
}
