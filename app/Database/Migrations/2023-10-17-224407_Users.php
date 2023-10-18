<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'userFirstName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'userLastName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'userEmail' => [
                'type'       => 'varchar',
                'constraint' => 40,
            ],
            'userPassword' => [
                'type'       => 'varchar',
                'constraint' => 60,
                'null'       => true,
            ],
            'userToken' => [
                'type'       => 'varchar',
                'constraint' => 13,
                'null'       => true,
            ],
            'isConfirmed' => [
                'type' => 'tinyint',
                'null' => true,
            ],
            'isAdmin' => [
                'type' => 'tinyint',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('userId', true);

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
