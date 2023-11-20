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
        $isCreated = true;
        if ($isCreated) {
            $response = [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el certificado correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Creación fallida',
                'message' => 'No se pudo realizar crear el certificado',
                'type'    => 'error',
            ];
        }

        return redirect()->to('/admin/certificados')->with('response', $response);
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
