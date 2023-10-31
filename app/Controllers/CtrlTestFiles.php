<?php

namespace App\Controllers;

use App\Exceptions\FileValidationException;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;
use App\Utils\FilepondManager;
use App\Utils\FilesConfig;
use Config\Services;

class CtrlTestFiles extends CtrlApiFiles
{
    protected $config;

    public function __construct()
    {
        $this->config['image'] = FilesConfig::builder('image')->isImage()->minFiles(2)->maxFiles(3)->maxSize(3000)->build();
        $this->config['svg'] = FilesConfig::builder('svg')->isSvg()->minFiles(1)->maxFiles(3)->maxSize(3000)->build();
        $this->config['video'] = FilesConfig::builder('video')->isVideo()->minFiles(1)->maxFiles(3)->maxSize(5000)->build();
        $this->config['pdf'] = FilesConfig::builder('pdf')->isPDF()->minFiles(2)->maxFiles(3)->maxSize(3000)->build();
    }

    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();
        return view("admin/test/testFiles", ["tests" => $tests]);
    }
    public function viewTestFilesCreate()
    {
        return view('admin/test/testFilesCreate', ["config" => FilepondManager::getFilepondConfig($this->config)]);
    }
    public function createTestFiles()
    {
        $data = $this->request->getPost();
        $testModel = new TestModel();
        $inputFiles = ["image", "svg", "video", "pdf"];
        $errors = [];
        $filesToSave = [];
        foreach ($inputFiles as $inputName) {
            $keys = empty($data[$inputName][0]) ? null : $data[$inputName];
            try {
                if($keys && $this->config[$inputName]) {
                    $files = FilePondManager::getSourceFiles($keys, "limbo");
                    $this->config[$inputName]->setFiles($files);
                    $validation = $this->config[$inputName]->getValidationConfig();
                    Services::fileValidation($validation["collection"], $validation["messages"])->run($files);
                    $filesToSave[$inputName] = $keys;
                }
            } catch (FileValidationException $th) {
                $validationErrors[$inputName] = $th->getFileValidationError();
                continue;
            }
        }

        if(empty($errors)) {
            $testModel->insert(["testName" => $data["name"]]);
            $testId = $testModel->getInsertID();
            foreach ($filesToSave as $inputName => $files) {
                foreach($files as $keyfile) {
                    $outputFolder = FILES_UPLOAD_DIRECTORY . $keyfile;
                    $sourceFolder = FILES_TEMP_DIRECTORY . $keyfile;
                    $filePath = scandir($sourceFolder)[2];

                    $folderData = [
                        "fileRoute" => "$outputFolder/$filePath",
                        "uuid" => $keyfile,
                        "fileDirectoryRoute" => $outputFolder,
                        "fileName" => $filePath
                    ];
                    $testFileModel = new TestFilesModel();
                    $testFileModel->createNewFile($folderData, $testId, $inputName);
                    FileManager::changeDirectoryFolder($sourceFolder, $outputFolder);
                }
            }
        } else {
            return redirect()->to("/admin/testFiles/crear")
                ->withInput()
                ->with("Test_filepondConfig", FilepondManager::getFilepondConfig($this->config))
                ->with("Test_validationError", $errors);
        }

        return redirect("admin/testFiles");
    }
    public function viewTestFilesEdit($id)
    {
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];
        $inputFiles = ["image", "svg", "video", "pdf"];
        foreach ($inputFiles as $inputName) {
            $files = array_map(function ($file) {
                return $file["uuid"];
            }, $testModel->getKeyFilesByType($id, $inputName));
            $this->config[$inputName]->setFiles(FilepondManager::getSourceFiles($files, "local"));
        }

        return view('admin/test/testFilesEdit', [
            "name" => $name,
            "config" => FilepondManager::getFilepondConfig($this->config)
        ]);
    }
    public function updateTestFiles($id)
    {
        $files = $this->request->getPost();
        $testModel = new TestModel();
        $newImages = FilepondManager::getNewFilesInFilepond($files['image'], $testModel->getKeyFilesByType($id, "image"));
        $deleteImages = $files["delete-image"] ?? [];

        foreach($newImages as $keyfile) {
            $outputFolder = FILES_UPLOAD_DIRECTORY . $keyfile;
            $sourceFolder = FILES_TEMP_DIRECTORY . $keyfile;
            $filePath = scandir($sourceFolder)[2];

            $folderData = [
                "fileRoute" => "$outputFolder/$filePath",
                "uuid" => $keyfile,
                "fileDirectoryRoute" => $outputFolder,
                "fileName" => $filePath
            ];

            $testFileModel = new TestFilesModel();
            $testFileModel->createNewFile($folderData, $id, "image");
            FileManager::changeDirectoryFolder($sourceFolder, $outputFolder);
        }

        $fileModel = new FileModel();
        foreach ($deleteImages as $keyfile) {
            $fileFolder = FILES_UPLOAD_DIRECTORY . $keyfile . "/";
            $fileModel->where("uuid", $keyfile)->delete();
            FileManager::deleteFolderWithContent($fileFolder);
        }

        return redirect("admin/testFiles");
    }
    public function deleteTestFiles()
    {
        echo "borrando test";
    }
}
