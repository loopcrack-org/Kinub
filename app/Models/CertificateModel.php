<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
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

            $certificateData['certificatePreviewId'] = $fileModel->insert(['uuid' => $certificateData['certificatePreview'][0]]);
            $certificateData['certificatefileId']    = $fileModel->insert(['uuid' => $certificateData['certificatefile'][0]]);

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
            $this->db->transException(true)->transStart();
            $fileModel = new FileModel();

            if (! empty($certificateData['certificatePreviewId'])) {
                $certificateData['certificatePreviewId'] = $fileModel->insert(['uuid' => $certificateData['certificatePreviewId'][0]]);
            } else {
                unset($certificateData['certificatePreviewId']);
            }

            if (! empty($certificateData['certificatefileId'])) {
                $certificateData['certificatefileId'] = $fileModel->insert(['uuid' => $certificateData['certificatefileId'][0]]);
            } else {
                unset($certificateData['certificatefileId']);
            }

            $this->update($certificateId, $certificateData);

            if (isset($certificateData['delete-certificatePreviewId'])) {
                $fileModel->where('uuid', $certificateData['delete-certificatePreviewId'][0])->delete();
            }

            if (isset($certificateData['delete-certificatefileId'])) {
                $fileModel->where('uuid', $certificateData['delete-certificatefileId'][0])->delete();
            }

            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function deleteCertificate(array $certificate)
    {
        try {
            $this->db->transException(true)->transStart();
            $isDeleted = $this->delete($certificate['certificateId']);
            if (! $isDeleted) {
                throw new Exception();
            }

            $fileModel = new FileModel();

            $queryWhere = "uuid={$this->escape($certificate['previewUuid'])} OR uuid={$this->escape($certificate['certificateUuid'])}";
            $isDeleted  = $fileModel->where($queryWhere)->delete();

            if (! $isDeleted) {
                throw new Exception();
            }

            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function getCertificate($id)
    {
        return $this->select('certificates.certificateId, certificates.certificatefileName,
                   preview.fileId AS previewFileId, preview.uuid AS previewUuid,
                   certfile.fileId AS certificateFileId, certfile.uuid AS certificateUuid')->join('files as preview', 'certificates.certificatePreviewId = preview.fileId', 'left')->join('files as certfile', 'certificates.certificatefileId = certfile.fileId', 'left')->where('certificates.certificateId', $id)->first();
    }
}
