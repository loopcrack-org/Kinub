<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Models\HomeSectionModel;
use App\Utils\FileManager;
use App\Validation\AboutUsValidation;
use Throwable;

class CtrlAboutUs extends CtrlApiFiles
{
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        $fileValidationConfigBuilder = new FileValidationConfigBuilder('/admin/nosotros');
        $fileValidationConfigBuilder->builder('aboutUsImage')->isImage()->minFiles(1)->maxFiles(1)->maxSize(2, 'MB')->maxDims(1200, 1000)->build();
        $fileValidationConfigBuilder->builder('aboutUsVideo')->isVideo()->minFiles(1)->maxFiles(1)->maxSize(1000, 'MB')->build();

        $this->fileConfig = $fileValidationConfigBuilder->getConfig();
    }

    public function viewAboutUsEdit()
    {
        $aboutUsData = (new HomeSectionModel())->getData();
        if (! session()->has('clientData')) {
            $dataFiles['aboutUsImage'] = [$aboutUsData['aboutUsImage']];
            $dataFiles['aboutUsVideo'] = [$aboutUsData['aboutUsVideo']];
        } else {
            $dataFiles = session()->get('clientData');
        }

        $this->fileConfig->setDataInClientConfig($dataFiles);

        return view('/admin/aboutUs/AboutUsEdit', ['aboutUsData' => $aboutUsData, 'filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    public function updateAboutUsSection()
    {
        try {
            $aboutUsData = $this->request->getPost();
            $validator   = new AboutUsValidation();

            if (! $validator->validateInputs($aboutUsData)) {
                throw new InvalidInputException($validator->getErrors(), '');
            }

            $homeSectionModel = new HomeSectionModel();
            $filesToSave      = $this->fileConfig->filterNewFilesInInputsFile($aboutUsData);

            $aboutUsData['aboutUsImage'] = $filesToSave['aboutUsImage'];
            $aboutUsData['aboutUsVideo'] = $filesToSave['aboutUsVideo'];

            $homeSectionModel->updateData($aboutUsData);

            foreach ($filesToSave as $files) {
                FileManager::changeDirectoryCollectionFolder($files);
            }

            $filesToDelete = $this->fileConfig->getKeysFolderToDelete($aboutUsData);

            foreach ($filesToDelete as $files) {
                FileManager::deleteMultipleFoldersWithContent($files);
            }

            $response = [
                'title'   => 'Actualización exitosa',
                'message' => 'Los datos de la sección sobre nosotros han sido actualizados correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/nosotros')->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            return redirect()->to('/admin/nosotros')->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al actualizar los datos, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/nosotros')->with('response', $response)->withInput();
        }
    }
}
