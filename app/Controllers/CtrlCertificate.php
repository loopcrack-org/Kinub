<?php

namespace App\Controllers;

use App\Models\CertificateModel;
use App\Validation\CertificateValidation;
use Exception;
use Throwable;

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
        $certificateModel = new CertificateModel();
        $certificate      = $certificateModel->select('certificateId, certificatefileName, fileRoute')->join('files', 'files.fileId = certificates.certificatePreviewId')->find($id);

        return view('admin/certificates/CertificateEdit', ['certificate' => $certificate]);
    }

    public function createCertificate()
    {
        $validateCertificate = new CertificateValidation();
        $certificateData     = $this->request->getPost(['certificatefileName']);

        try {
            if (! $validateCertificate->validateInputs($certificateData)) {
                throw new Exception();
            }

            $certificateData['certificatePreviewId'] = 1;
            $certificateData['certificatefileId']    = 1;

            $certificateModel = new CertificateModel();
            $isCreated        = $certificateModel->insert($certificateData);
            if ($isCreated) {
                $response = [
                    'title'   => 'Creación exitosa',
                    'message' => 'Se ha creado el certificado correctamente',
                    'type'    => 'success',
                ];
            } else {
                throw new Exception('Algo salió mal al registrar el certificado. Por favor, inténtalo de nuevo.');
            }
        } catch (Throwable $th) {
            $errors = $validateCertificate->getErrors();

            if (empty($errors)) {
                $response = [
                    'title'   => '¡Oops!',
                    'message' => $th->getMessage(),
                    'type'    => 'error',
                ];
            } else {
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        }

        return redirect()->to('/admin/certificados')->with('response', $response);
    }

    public function updateCertificate($id)
    {
        $isUpdated = true;
        if ($isUpdated) {
            $response = [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha editado el certificado correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Edición fallida',
                'message' => 'No se pudo realizar la edición del certificado',
                'type'    => 'error',
            ];
        }

        return redirect()->to('/admin/certificados')->with('response', $response);
    }

    public function deleteCertificate()
    {
        return 'delete certificate ...';
    }
}
