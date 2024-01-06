<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Libraries\tinify\Tinify;
use App\Models\CertificateModel;
use App\Utils\FileManager;
use App\Validation\CertificateValidation;
use Exception;
use Throwable;

class CtrlCertificate extends CtrlApiFiles
{
    private static $CERTIFICATES_BASE_ROUTE;
    private static $CERTIFICATES_CREATE_ROUTE;
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        self::$CERTIFICATES_BASE_ROUTE   = url_to(self::class . '::viewCertificates');
        self::$CERTIFICATES_CREATE_ROUTE = url_to(self::class . '::viewCertificateCreate');

        $fileConfigBuilder = new FileValidationConfigBuilder(self::$CERTIFICATES_BASE_ROUTE);
        $fileConfigBuilder->builder('certificatePreview')->minFiles(1)->maxFiles(1)->maxSize(2, 'MB')->isImage()->maxDims(700, 700)->build();
        $fileConfigBuilder->builder('certificatefile')->minFiles(1)->maxFiles(1)->maxSize(30, 'MB')->isPDF()->build();

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
        $certificate      = $certificateModel->getCertificate($id);

        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        } else {
            $dataFiles['certificatePreview'] = [$certificate['previewUuid']];
            $dataFiles['certificatefile']    = [$certificate['certificateUuid']];
            $this->fileConfig->setDataInClientConfig($dataFiles);
        }

        return view('admin/certificates/CertificateEdit', [
            'certificate'    => $certificate,
            'filepondConfig' => $this->fileConfig->getClientConfig(),
        ]);
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
            FileManager::changeDirectoryCollectionFolder($certificateData['certificatePreview']);
            FileManager::changeDirectoryCollectionFolder($certificateData['certificatefile']);
            Tinify::convertImages($certificateData['certificatePreview']);

            $response = [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$CERTIFICATES_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $certificateData);

            return redirect()->to(self::$CERTIFICATES_CREATE_ROUTE)->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $certificateData);

            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al crear el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->to(self::$CERTIFICATES_CREATE_ROUTE)->withInput()->with('response', $response);
        }
    }

    public function updateCertificate(string $certificateId)
    {
        try {
            $certificateData = $this->request->getPost();

            $validateCertificate  = new CertificateValidation();
            $filesValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validateCertificate->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);

            if (! $validateCertificate->validateInputs($certificateData)) {
                throw new InvalidInputException($validateCertificate->getErrors());
            }

            $certificateModel = new CertificateModel();
            $filesToSave      = $this->fileConfig->filterNewFilesInInputsFile($certificateData);

            $certificateData['certificatePreviewId'] = $filesToSave['certificatePreview'];
            $certificateData['certificatefileId']    = $filesToSave['certificatefile'];

            $certificateModel->updateCertificate($certificateId, $certificateData);

            foreach ($filesToSave as $files) {
                FileManager::changeDirectoryCollectionFolder($files);
            }

            $filesToDelete = $this->fileConfig->getKeysFolderToDelete($certificateData);

            foreach ($filesToDelete as $files) {
                FileManager::deleteMultipleFoldersWithContent($files);
            }

            $response = [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha editado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$CERTIFICATES_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            return redirect()->to(url_to(self::class . '::viewCertificateEdit', $certificateId))->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al editar el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->to(url_to(self::class . '::viewCertificateEdit', $certificateId))->with('response', $response);
        }
    }

    public function deleteCertificate()
    {
        try {
            $certificateId    = $this->request->getPost('certificateId');
            $certificateModel = new CertificateModel();
            $certificate      = $certificateModel->getCertificate($certificateId);

            if (empty($certificate)) {
                throw new Exception();
            }

            $certificateModel->deleteCertificate($certificate);

            FileManager::deleteMultipleFoldersWithContent([$certificate['previewUuid'], $certificate['certificateUuid']]);

            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el certificado correctamente',
                'type'    => 'success',
            ];
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'Algo salió mal al eliminar el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];
        }

        return redirect()->to(self::$CERTIFICATES_BASE_ROUTE)->with('response', $response);
    }
}
