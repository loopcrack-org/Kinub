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
            $this->db->transException(true)->transStart();

            $fileModel = new FileModel();

            $certificateData['certificatePreviewId'] = $fileModel->insert(['uuid' => $certificateData['certificatePreviewId'][0]]);
            $certificateData['certificatefileId']    = $fileModel->insert(['uuid' => $certificateData['certificatefileId'][0]]);

            $this->insert($certificateData);

            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function updateCertificate(string $certificateId, array $certificateData)
    {
        try {
            $this->db->transStart();

            $this->update($certificateId, $certificateData);

            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
