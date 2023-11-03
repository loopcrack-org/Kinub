<?php

namespace App\Controllers;

use App\Classes\FileConfig;
use App\Exceptions\FileValidationException;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileCollectionValidation;
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
            FileConfig::builder('image')->previewImage()->acceptTypesFile(['image/jpg', 'image/png', 'image/jpeg'], "Selecciona archivos jpg, jpeg o png")->minFiles(1)->maxFiles(1)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('icon')->previewImage()->acceptTypesFile(['image/svg+xml'], "Selecciona archivos svg")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('video')->previewVideo()->acceptTypesFile(['video/mp4'], "Selecciona archivos de video")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
            FileConfig::builder('datasheet')->previewPDF()->acceptTypesFile(['application/pdf'], "Selecciona archivos pdf")->maxFiles(3)->maxSize(3000)->allowMultipleFiles()->build(),
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
        $config = $this->getConfig();
        if(session()->has("config")) {
            $config = session()->get("config");
            session()->remove("config");
        }
        return view('admin/test/testFilesCreate', ["config" => FilepondManager::getFilepondConfig($config)]);
    }
    public function createTestFiles()
    {
        try {
            // get data
            $data = $this->request->getPost();
            // getInputs
            $name = $data["name"];
            unset($data["name"]);
            $filesPost = FileUtils::sanitizeAndMapPostData($data);
            // validation
            $passed = true;
            foreach ($filesPost as $inputName => $keyFiles) {
                /** @var \App\Classes\FileConfig $inputConfig*/ 
                $inputConfig = $this->getConfig()[$inputName];
                $fileValidation = $inputConfig->getFileValidation();
                $success = $fileValidation->validateCollectionFiles($keyFiles);
                if(!$success) {
                    $passed = false;
                    $inputConfig->getFilepondConfig()->setError($fileValidation->getError());
                }
                if(!$passed) {
                    $inputConfig->getFilepondConfig()->setFiles(
                        FilepondManager::getSourceFiles($filesPost[$inputName], "limbo")
                    );
                }
            }
            if(!$passed) throw new FileValidationException();


            // save name on db
            $testModel = new TestModel();
            $testId = $testModel->insert(["testName" => $name], true);
            // save files on db
            foreach ($filesPost as $inputName => $keyFiles) {
                if (!empty($keyFiles)) {
                    $fileEntities = FileUtils::getFileEntities($keyFiles);
                    $testFileModel = new TestFilesModel();
                    $testFileModel->saveFiles($fileEntities, $testId, $inputName);
                    FileManager::changeDirectoryCollectionFolder($keyFiles);
                }
            }
            return redirect("admin/testFiles");
        } catch (FileValidationException $th) {
            session()->set("config", $this->getConfig());
            return redirect()->to("/admin/testFiles/crear")->withInput();
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->to("/admin/testFiles/crear")->withInput()->with("error", "Error el guardar el test");
        }
    }
    public function viewTestFilesEdit($id)
    {
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];

        $config = $this->getConfig();
        if(session()->has("config")) {
            $config = session()->get("config");
            session()->remove("config");
        } else {
            foreach ($config as $inputName=> $inputConfig) {
                /** @var \App\Classes\FileConfig $inputConfig*/ 
                $type = $inputConfig->getInputName();
                $keyFiles = $testModel->getKeyFilesByType($id, $type);
                $inputConfig->getFilepondConfig()->setFiles(
                    FilepondManager::getSourceFiles($keyFiles, "local")
                );
            }
        }



        return view('admin/test/testFilesEdit', [
            "name" => $name,
            "config" => FilepondManager::getFilepondConfig($config),
        ]);
    }
    public function updateTestFiles($id)
    {
        try {
            $data = $this->request->getPost();
            $name = $data["name"];
            unset($data["name"]);
            $filesPost = FileUtils::sanitizeAndMapPostData($data);
            
            $auxFiles = [];

            $passed = true;
            foreach ($filesPost as $inputName => $keyFiles) {
                // validation
                /** @var \App\Classes\FileConfig $inputConfig*/ 
                if(!isset($this->getConfig()[$inputName])) {
                    continue;
                }
                $inputConfig = $this->getConfig()[$inputName];
                $fileValidation = $inputConfig->getFileValidation();
                $success = $fileValidation->validateCollectionFiles($keyFiles);

                // files
                $testModel = new TestModel();
                $localFiles = $testModel->getKeyFilesByType($id, $inputName);
                $newFiles = array_diff($keyFiles, $localFiles);
                $deleteFiles = $filesPost["delete-$inputName"] ?? [];

                if($success) {
                    $auxFiles[$inputName]["newFiles"] = $newFiles;
                    $auxFiles[$inputName]["delete"] = $deleteFiles;
                } else {
                    $passed = false;
                    $inputConfig->getFilepondConfig()->setError($fileValidation->getError());
                }
                if(!$passed) {
                    // files to filepond
                    $allFiles = array_merge(
                        FilepondManager::getSourceFiles($newFiles, "limbo"),
                        FilepondManager::getSourceFiles($localFiles, "local"),
                    );
                    // set files
                    /** @var \App\Classes\FileConfig $inputConfig*/ 
                    $inputConfig->getFilepondConfig()->setFiles($allFiles);
                    $inputConfig->getFilepondConfig()->setDeletedFiles($deleteFiles);
                }
            }
            if(!$passed) throw new FileValidationException();

            // here save your new files and delete the required files
            // save name on db
            $testModel = new TestModel();
            $testModel->update($id, ["testName" => $name]);
            // save files on db
            foreach ($auxFiles as $inputName => $keyFiles) {
                $testFileModel = new TestFilesModel();
                if (!empty($keyFiles["newFiles"])) {

                    $fileEntities = FileUtils::getFileEntities($keyFiles["newFiles"]);
                    $testFileModel->saveFiles($fileEntities, $id, $inputName);
                    FileManager::changeDirectoryCollectionFolder($keyFiles["newFiles"]);
                }
                if (!empty($keyFiles["delete"])) {
                    $testFileModel->deleteFiles($keyFiles["delete"]);
                }
            }

            return redirect("admin/testFiles");
        } catch(FileValidationException $th) {
            session()->set("config", $this->getConfig());
            return redirect()->to("/admin/testFiles/editar/$id")->withInput();
        }
        catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function deleteTestFiles()
    {
        echo "borrando test";
    }
}
