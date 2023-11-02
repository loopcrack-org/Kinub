<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmailTypeSeeder extends Seeder
{
    public function run()
    {
        $emailTypes = [
            [
                'emailTypeName' => 'contacto',
            ],
            [
                'emailTypeName' => 'soporte técnico',
            ],
            [
                'emailTypeName' => 'información producto',
            ],
        ];

        $this->db->table('email_types')->insertBatch($emailTypes);
    }
}
