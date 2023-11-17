<?php

namespace App\Controllers;

use App\Models\CertificateModel;

class CtrlCertificate extends BaseController
{
    public function viewCertificates()
    {
        $certificateModel = new CertificateModel();
        $certificates     = $certificateModel->select('certificateId, certificatefileName, fileRoute')->join('files', 'files.fileId = certificates.certificatePreviewId')->findAll();

        return view('admin/certificates/Certificates', [
            'certificates' => $certificates,
        ]);
    }

    public function viewCertificateCreate()
    {
        return view('admin/certificates/CertificateCreate');
    }

    public function viewCertificateEdit($id)
    {
        return view('admin/certificates/CertificateEdit', ['id' => $id]);
    }

    public function createCertificate()
    {
        return 'creating certificate...';
    }

    public function updateCertificate($id)
    {
        return "updating certificate... {$id}";
    }

    public function deleteCertificate()
    {
        return 'delete certificate ...';
    }
}
