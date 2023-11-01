<?php

namespace App\Controllers;

use App\Exceptions\FileValidationException;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileCollection;
use App\Utils\FileManager;
use App\Utils\FilepondManager;
use App\Utils\FilesConfig;
use App\Utils\FileUtils;
use App\Utils\FileValidationCollection;
use Config\Services;

class CtrlTestFiles extends CtrlApiFiles
{
    protected $config;

    public function __construct()
    {
        $this->config= [
            FilesConfig::builder('image')->isImage()->minFiles(2)->maxFiles(3)->maxSize(30)->build(),
            FilesConfig::builder('svg')->isSvg()->minFiles(1)->maxFiles(3)->maxSize(3000)->build(),
            FilesConfig::builder('video')->isVideo()->minFiles(1)->maxFiles(3)->maxSize(5000)->build(),
            FilesConfig::builder('pdf')->isPDF()->minFiles(2)->maxFiles(3)->maxSize(3000)->build(),
        ];
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
        try {
            // get data
            $data = $this->request->getPost();
            // validate
            $validation = new FileCollection();
            $validation->validateCollectionFiles($data, $this->config);
            if($validation->hasCollectionErrors()) new FileValidationException();
            
            // save name on db
            $testModel = new TestModel();
            $testId = $testModel->insert(["testName" => $data["name"]], true);
            // save files on db
            foreach ($this->config as $config) {
                $type = $config->getInputName();
                $keys = $data[$type];
                $files = FileUtils::getFileEntities($keys);
                $testFileModel = new TestFilesModel();
                $testFileModel->saveFiles($files, $testId, $type);
                FileManager::changeDirectoryCollectionFolder($keys);
            }
            return redirect("admin/testFiles");
        } catch (FileValidationException $th) {
            return redirect()->to("/admin/testFiles/crear")
                ->withInput()
                ->with("Test_filepondConfig", FilepondManager::getFilepondConfig($this->config))
                ->with("Test_validationError", $validation->getErrors());
        } catch (\Throwable $th) {
            return "Hubo un error";
            return redirect()->to("/admin/testFiles/crear")
                ->withInput()
                ->with("error", "Error el guardar el test");
        }
    }
    public function viewTestFilesEdit($id)
    {
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];

        

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
            // FileManager::changeDirectoryFolder($sourceFolder, $outputFolder);
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
