<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MeasurementSolutions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'msId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'msName' => [
                'type'       => 'varchar',
                'constraint' => 45,
            ],
            'msIconId' => [
                'type' => 'int',
            ],
            'msImageId' => [
                'type' => 'int',
            ],
            'msDescription' => [
                'type'       => 'varchar',
                'constraint' => 120,
            ],
        ]);

        $this->forge->addKey('msId', true);

        $this->forge->addForeignKey('msIconId', 'files', 'fileId');
        $this->forge->addForeignKey('msImageId', 'files', 'fileId');

        $this->forge->createTable('measurement_solutions');
    }

    public function down()
    {
        $this->forge->dropTable('measurement_solutions');
    }
}
