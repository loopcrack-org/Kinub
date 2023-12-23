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
                'null' => true,
            ],
            'msImageId' => [
                'type' => 'int',
                'null' => true,
            ],
            'msDescription' => [
                'type'       => 'varchar',
                'constraint' => 120,
            ],
        ]);

        $this->forge->addKey('msId', true);

        $this->forge->addForeignKey('msIconId', 'files', 'fileId', 'SET NULL', 'SET NULL', 'measurement_solution_icon_FK');
        $this->forge->addForeignKey('msImageId', 'files', 'fileId', 'SET NULL', 'SET NULL', 'measurement_solution_image_FK');

        $this->forge->createTable('measurement_solutions');
    }

    public function down()
    {
        $this->forge->dropTable('measurement_solutions');
    }
}
