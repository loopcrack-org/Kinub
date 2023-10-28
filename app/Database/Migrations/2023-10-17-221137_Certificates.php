<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Certificates extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'certificateId' => [
                'type'           => 'int',
                'auto_increment' => true,
            ],
            'certificatefileName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'certificatePreviewId' => [
                'type' => 'int',
            ],
            'certificatefileId' => [
                'type' => 'int',
            ],
        ]);

        $this->forge->addKey('certificateId', true);

        $this->forge->addForeignKey('certificatePreviewId', 'files', 'fileId', 'CASCADE', 'CASCADE', 'certificate_preview_FK');
        $this->forge->addForeignKey('certificatefileId', 'files', 'fileId', 'CASCADE', 'CASCADE', 'certificate_file_FK');

        $this->forge->createTable('certificates');
    }

    public function down()
    {
        $this->forge->dropTable('certificates');
    }
}
