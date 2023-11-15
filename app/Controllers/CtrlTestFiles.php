<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;
use App\Validation\TestValidation;
use Exception;

class CtrlTestFiles extends CtrlApiFiles
{
    protected FileValidationConfig $fileValidationConfig;

    public function __construct()
    {
        $configBuilder = new FileValidationConfigBuilder("/admin/testFiles");
        $configBuilder->builder('image')->maxFiles(2)->minSize(500, "KB")->maxSize(2, "MB")->allowMultipleFiles()->isImage()->maxDims(200, 200)->build();
        $configBuilder->builder('video')->maxFiles(2)->allowMultipleFiles()->isVideo()->build();
        $configBuilder->builder('icon')->maxFiles(2)->maxDims(200, 200)->isSVG()->allowMultipleFiles()->build();
        $configBuilder->builder('datasheet')->maxFiles(2)->allowMultipleFiles()->isPDF()->build();

        $this->fileValidationConfig = $configBuilder->getConfig();
    }

    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();
        return view("admin/test/testFiles", ["tests" => $tests]);
    }
    public function viewTestFilesCreate()
    {
        if (session()->has('clientData')) {
            $this->fileValidationConfig->setDataInClientConfig(session()->get('files'));
        }

        return view('admin/test/testFilesCreate', ["config" => $this->fileValidationConfig->getClientConfig()]);
    }
    public function createTestFiles()
    {
        $data = $this->request->getPost();
        try {
            $filesValidationRules = $this->fileValidationConfig->getCollectionFileValidationRules();
            $validator = new TestValidation();
            $validator->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);
            if (!$validator->validateInputs($data)) {
                throw new Exception();
            }
            $testModel = new TestModel();
            $testId = $testModel->insert(["testName" => $data['name']], true);
            $testFileModel = new TestFilesModel();

            $dataFiles = $this->fileValidationConfig->filterNewFilesInInputsFile($data);

            foreach ($dataFiles as $inputName => $files) {
                if (!empty($files)) {
                    $testFileModel->saveFiles($files, $testId, $inputName);
                    FileManager::changeDirectoryCollectionFolder($files);
                }
            }

            return redirect("admin/testFiles");
        } catch (\Throwable $th) {
            session()->setFlashdata("clientData", $data);
            return redirect()->to("/admin/testFiles/crear")->withInput();
        }
    }
    public function viewTestFilesEdit($id)
    {
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];

        if (session()->has('clientData')) {
            $this->fileValidationConfig->setDataInClientConfig(session()->get('clientData'));
        } else {
            $dataFiles['image'] = $testModel->getKeyFilesByType($id, 'image');
            $dataFiles['video'] = $testModel->getKeyFilesByType($id, 'video');
            $dataFiles['icon'] = $testModel->getKeyFilesByType($id, 'icon');
            $dataFiles['datasheet'] = $testModel->getKeyFilesByType($id, 'datasheet');
            $this->fileValidationConfig->setDataInClientConfig($dataFiles);
        }
        return view('admin/test/testFilesEdit', [
                    "name" => $name,
                    "config" => $this->fileValidationConfig->getClientConfig(),
        ]);
    }
    public function updateTestFiles($testId)
    {
        $data = $this->request->getPost();
        try {
            $filesValidationRules = $this->fileValidationConfig->getCollectionFileValidationRules();
            $validator = new TestValidation();
            $validator->addRules($filesValidationRules['rules'], $filesValidationRules['messages']);
            if (!$validator->validateInputs($data)) {
                throw new Exception();
            }

            $testModel = new TestModel();
            $testModel->update($testId, ["testName" => $data['name']]);
            $newFiles = $this->fileValidationConfig->filterNewFilesInInputsFile($data);
            if ($newFiles) {
                $testFileModel = new TestFilesModel();
                foreach ($newFiles as $type => $files) {
                    $testFileModel->saveFiles($files, $testId, $type);
                    FileManager::changeDirectoryCollectionFolder($files);
                }
            }

            $deleteFiles = $this->fileValidationConfig->getKeysFolderToDelete($data);
            if ($deleteFiles) {
                $testFileModel = new TestFilesModel();
                foreach ($deleteFiles as $keysFoldersToDelete) {
                    $testFileModel->deleteFiles($keysFoldersToDelete);
                    FileManager::deleteMultipleFoldersWhitContent($keysFoldersToDelete);
                }
            }

            return redirect("admin/testFiles");
        } catch (\Throwable $th) {
            session()->setFlashdata("clientData", $data);
            return redirect()->to("/admin/testFiles/editar/$testId")->withInput();
        }
    }
    public function deleteTestFiles()
    {
        echo "borrando test";
    }
}
