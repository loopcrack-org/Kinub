<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run()
    {
        $certificates = [
            [
                'certificatefileName'  => 'certificado1',
                'certificatePreviewId' => 1,
                'certificatefileId'    => 1,
            ],
            [
                'certificatefileName'  => 'certificado2',
                'certificatePreviewId' => 1,
                'certificatefileId'    => 1,
            ],
            [
                'certificatefileName'  => 'certificado3',
                'certificatePreviewId' => 1,
                'certificatefileId'    => 1,
            ],
        ];

        $this->db->table('certificates')->insertBatch($certificates);
    }
}
