<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class CertificateModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'certificates';
    protected $primaryKey    = 'certificateId';
    protected $allowedFields = ['certificatefileName', 'certificatePreviewId', 'certificatefileId'];

    public function createCertificate(array $certificateData)
    {
        try {
            $this->db->transStart();

            $fileModel                               = new FileModel();
            $certificateData['certificatePreviewId'] = $fileModel->insert(['uuid' => $certificateData['certificatePreviewId']]);
            $certificateData['certificatefileId']    = $fileModel->insert(['uuid' => $certificateData['certificatefileId']]);
            $this->insert($certificateData);

            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
