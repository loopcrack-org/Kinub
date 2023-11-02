<?php

namespace App\Controllers;

use App\Classes\FileConfig;
use App\Exceptions\FileValidationException;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileCollection;
use App\Utils\FileManager;
use App\Utils\FilepondManager;
use App\Utils\FileUtils;

use function PHPUnit\Framework\isEmpty;

//use App\Utils\FileUtils;


class CtrlTestFiles extends CtrlApiFiles
{
    public function __construct()
    {
        $config = [
            FileConfig::builder('image')->previewImage()->acceptTypesFile(['image/jpg', 'image/png', 'image/jpeg'], "Selecciona archivos jpg, jpeg o png")->minFiles(1)->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('svg')->previewImage()->acceptTypesFile(['image/svg+xml'], "Selecciona archivos svg")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('video')->previewVideo()->acceptTypesFile(['video/mp4'], "Selecciona archivos de video")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('pdf')->previewPDF()->acceptTypesFile(['application/pdf'], "Selecciona archivos pdf")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
        ];

        parent::__construct($config);
    }

    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();
        return view("admin/test/testFiles", ["tests" => $tests]);
    }
    public function viewTestFilesCreate()
    {
        return view('admin/test/testFilesCreate', ["config" => FilepondManager::getFilepondConfig(parent::getConfig())]);
    }
    public function createTestFiles()
    {
        try {
            // get data
            $data = $this->request->getPost();
            // validate
            $validation = new FileCollection();

            $validation->validateCollectionFiles($data, parent::getConfig());
            if($validation->hasCollectionErrors()) {
                new FileValidationException($validation->getErrors());
            }

            // save name on db
            $testModel = new TestModel();
            $testId = $testModel->insert(["testName" => $data["name"]], true);
            // save files on db
            foreach (parent::getConfig() as $key => $config) {
                $type = $key;
                $keys = $data[$type] ?? [];
                if (!isEmpty($keys)) {
                    $files = FileUtils::getFileEntities($keys);
                    $testFileModel = new TestFilesModel();
                    $testFileModel->saveFiles($files, $testId, $type);
                    FileManager::changeDirectoryCollectionFolder($keys);
                }
            }
            return redirect("admin/testFiles");
        } catch (FileValidationException $th) {
            return redirect()->to("/admin/testFiles/crear")
                ->withInput()
                ->with("Test_filepondConfig", FilepondManager::getFilepondConfig(parent::getConfig()))
                ->with("Test_validationError", $th->getMessage());
        } catch (\Throwable $th) {
            return $th->getMessage();
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
            "config" => FilepondManager::getFilepondConfig(parent::getConfig())
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
            //FileManager::changeDirectoryFolder($sourceFolder, $outputFolder);
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
