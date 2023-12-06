<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Libraries\tinify\Tinify;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;
use App\Validation\TestValidation;
use Exception;
use Throwable;

class CtrlTestFiles extends CtrlApiFiles
{
    /**
     * This variable containes the filepond configuration
     */
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        $fileConfigBuilder = new FileValidationConfigBuilder('/admin/testFiles');
        $fileConfigBuilder->builder('image')->minFiles(1)->maxFiles(2)->minSize(50, 'KB')->maxSize(2, 'MB')->allowMultipleFiles()->isImage()->maxDims(3000, 3000)->build();
        $fileConfigBuilder->builder('video')->maxFiles(2)->allowMultipleFiles()->isVideo()->build();
        $fileConfigBuilder->builder('datasheet')->maxFiles(2)->allowMultipleFiles()->isPDF()->build();

        $this->fileConfig = $fileConfigBuilder->getConfig();
    }

    /**
     * View for visualize all register of a file test
     *
     * This method return the view with the tests table
     *
     * @return string
     */
    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();

        return view('admin/test/testFiles', ['tests' => $tests]);
    }

    /**
     * View for create a file test register
     *
     * @return string
     */
    public function viewTestFilesCreate()
    {
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        }

        return view('admin/test/testFilesCreate', ['filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    /**
     * Creates a register of a file test
     */
    public function createTestFiles()
    {
        $data = $this->request->getPost();

        try {
            $filesValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validator            = new TestValidation();
            $validator->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);
            if (! $validator->validateInputs($data)) {
                throw new Exception();
            }
            $testModel     = new TestModel();
            $testId        = $testModel->insert(['testName' => $data['name']], true);
            $testFileModel = new TestFilesModel();

            $dataFiles = $this->fileConfig->filterNewFilesInInputsFile($data);

            foreach ($dataFiles as $inputName => $files) {
                if (! empty($files)) {
                    $testFileModel->saveFiles($files, $testId, $inputName);
                    FileManager::changeDirectoryCollectionFolder($files);

                    if ($inputName === 'image') {
                        Tinify::convertImages($files);
                    }
                }
            }

            return redirect('admin/testFiles')->with('response', [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el test correctamente',
                'type'    => 'success',
            ]);
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $data);

            return redirect()->to('/admin/testFiles/crear')->withInput();
        }
    }

    /**
     * View for edit a file test register
     *
     * @param string $id the id of the file test register
     */
    public function viewTestFilesEdit($id)
    {
        $testModel = new TestModel();
        $name      = $testModel->select('testName')->where('testId', $id)->first()['testName'];

        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        } else {
            $dataFiles['image']     = $testModel->getKeyFilesByType($id, 'image');
            $dataFiles['video']     = $testModel->getKeyFilesByType($id, 'video');
            $dataFiles['datasheet'] = $testModel->getKeyFilesByType($id, 'datasheet');
            $this->fileConfig->setDataInClientConfig($dataFiles);
        }

        return view('admin/test/testFilesEdit', [
            'name'           => $name,
            'filepondConfig' => $this->fileConfig->getClientConfig(),
        ]);
    }

    /**
     * Update a register of a file test
     *
     * @param string $testId the id of the file test register
     */
    public function updateTestFiles($testId)
    {
        $data = $this->request->getPost();

        try {
            $filesValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validator            = new TestValidation();
            $validator->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);
            if (! $validator->validateInputs($data)) {
                throw new Exception();
            }

            $testModel = new TestModel();
            $testModel->update($testId, ['testName' => $data['name']]);
            $newFiles = $this->fileConfig->filterNewFilesInInputsFile($data);
            if ($newFiles) {
                $testFileModel = new TestFilesModel();

                foreach ($newFiles as $type => $files) {
                    $testFileModel->saveFiles($files, $testId, $type);
                    FileManager::changeDirectoryCollectionFolder($files);

                    if ($type === 'image') {
                        Tinify::convertImages($files);
                    }
                }
            }

            $deleteFiles = $this->fileConfig->getKeysFolderToDelete($data);
            if ($deleteFiles) {
                $testFileModel = new TestFilesModel();

                foreach ($deleteFiles as $keysFoldersToDelete) {
                    $testFileModel->deleteFiles($keysFoldersToDelete);
                    FileManager::deleteMultipleFoldersWithContent($keysFoldersToDelete);
                }
            }

            return redirect('admin/testFiles')->with('response', [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha editado el test correctamente',
                'type'    => 'success',
            ]);
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $data);

            return redirect()->to("/admin/testFiles/editar/{$testId}")->withInput();
        }
    }

    /**
     * Delete a file test register
     */
    public function deleteTestFiles()
    {
        try {
            $testModel     = new TestModel();
            $testFileModel = new TestFilesModel();

            $id       = $this->request->getPost('testId');
            $keyFiles = $testModel->getKeyFiles($id);
            $testFileModel->deleteFiles($keyFiles);
            FileManager::deleteMultipleFoldersWithContent($keyFiles);

            $testModel->delete($id);

            return redirect()->to('/admin/testFiles')->with('response', [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha eliminado el test correctamente',
                'type'    => 'success',
            ]);
        } catch (Throwable $th) {
            return redirect()->to('/admin/testFiles')->with('response', [
                'title'   => 'Eliminación fallida',
                'message' => 'Algo salio mal al eliminar el test. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ]);
        }
    }
}
