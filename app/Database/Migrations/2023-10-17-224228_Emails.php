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
            'emailContent' => [
                'type' => 'text',
            ],
        ]);

        $this->forge->addKey('emailId', true);

        $this->forge->addForeignKey('emailTypeId', 'email_types', 'emailTypeId');

        $this->forge->createTable('emails');
    }

    public function down()
    {
        $this->forge->dropTable('emails');
    }
}
