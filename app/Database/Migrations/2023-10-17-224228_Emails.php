<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Emails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'emailId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'emailTypeId' => [
                'type' => 'int',
            ],
            'inquirerName' => [
                'type'       => 'varchar',
                'constraint' => 120,
            ],
            'inquirerEmail' => [
                'type'       => 'varchar',
                'constraint' => 40,
            ],
            'emailContent' => [
                'type' => 'text',
            ],
        ]);

        $this->forge->addKey('emailId', true);

        $this->forge->addForeignKey('emailTypeId', 'email_types', 'emailTypeId', 'CASCADE', 'CASCADE', 'email_emailType_FK');

        $this->forge->createTable('emails');
    }

    public function down()
    {
        $this->forge->dropTable('emails');
    }
}
