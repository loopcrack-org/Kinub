<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\CertificateModel;
use App\Validation\CertificateValidation;
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
        try {
            $validateCertificate = new CertificateValidation();
            $certificateData     = $this->request->getPost();
            if (! $validateCertificate->validateInputs($certificateData)) {
                throw new InvalidInputException($validateCertificate->getErrors());
            }

            $certificateData['certificatePreviewId'] = '4fe307c224811d55048d72b5696895eb';
            $certificateData['certificatefileId']    = '4fe307c224811d55048d72b5696895eb';

            (new CertificateModel())->createCertificate($certificateData);
            $response = [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/certificados')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->back()->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al crear el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->back()->withInput()->with('response', $response);
        }
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
