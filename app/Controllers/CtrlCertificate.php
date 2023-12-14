<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Models\CertificateModel;
use App\Utils\FileManager;
use App\Validation\CertificateValidation;
use Throwable;

class CtrlCertificate extends CtrlApiFiles
{
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        $fileConfigBuilder = new FileValidationConfigBuilder('/admin/certificados');
        $fileConfigBuilder->builder('certificatePreviewId')->minFiles(1)->maxSize(2, 'MB')->isImage()->maxDims(1000, 1500)->build();
        $fileConfigBuilder->builder('certificatefileId')->minFiles(1)->maxSize(30, 'MB')->isPDF()->build();

        $this->fileConfig = $fileConfigBuilder->getConfig();
    }

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
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        }

        return view('admin/certificates/CertificateCreate', ['filepondConfig' => $this->fileConfig->getClientConfig()]);
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
            $certificateData = $this->request->getPost();

            $validateCertificate  = new CertificateValidation();
            $filesValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validateCertificate->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);

            if (! $validateCertificate->validateInputs($certificateData)) {
                throw new InvalidInputException($validateCertificate->getErrors());
            }

            (new CertificateModel())->createCertificate($certificateData);
            FileManager::changeDirectoryCollectionFolder($certificateData['certificatePreviewId']);
            FileManager::changeDirectoryCollectionFolder($certificateData['certificatefileId']);

            $response = [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/certificados')->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $certificateData);

            return redirect()->back()->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $certificateData);

            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al crear el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->back()->withInput()->with('response', $response);
        }
    }

    public function updateCertificate(string $certificateId)
    {
        try {
            $validateCertificate = new CertificateValidation();
            $certificateData     = $this->request->getPost();
            if (! $validateCertificate->validateInputs($certificateData)) {
                throw new InvalidInputException($validateCertificate->getErrors());
            }

            $certificateData['certificatePreviewId'] = '1';
            $certificateData['certificatefileId']    = '1';

            (new CertificateModel())->updateCertificate($certificateId, $certificateData);
            $response = [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha editado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/certificados')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->back()->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al editar el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->back()->withInput()->with('response', $response);
        }

        return redirect()->to('/admin/certificados')->with('response', $response);
    }

    public function deleteCertificate()
    {
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el certificado correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'No se pudo realizar la elimiación del certificado',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
