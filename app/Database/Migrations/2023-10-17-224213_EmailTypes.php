<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailTypes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'emailTypeId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'emailTypeName' => [
                'type'       => 'varchar',
                'constraint' => 45,
            ],
        ]);

        $this->forge->addKey('emailTypeId', true);

        $this->forge->createTable('email_types');
    }

    public function down()
    {
        $this->forge->dropTable('email_types');
    }
}
