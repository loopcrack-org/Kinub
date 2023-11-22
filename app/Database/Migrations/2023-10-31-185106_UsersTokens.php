<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userTokenId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'userToken' => [
                'type'       => 'varchar',
                'constraint' => 13,
            ],
            'tokenExpiryDate' => [
                'type' => 'date',
            ],
            'userId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('userTokenId', true);
        $this->forge->addForeignKey('userId', 'users', 'userId', 'CASCADE', 'CASCADE', 'user-token_User_FK');

        $this->forge->createTable('user_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('user_tokens');
    }
}
