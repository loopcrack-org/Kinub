<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;
use App\Validation\ChunkFilesValidation;
use Exception;

class CtrlTestFiles extends BaseController
{
    private $folderTemp = "./files/tmp/";
    private $folderUpload = "./uploads/";
    protected $configFiles = [
       [
            "name" => "image",
            "acceptedFileTypes" => ["image/jpg", "image/png", "image/jpeg"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona jpg, jpeg o png",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "checkValidity" => true,
            "chunkSize" => 100000,
            "allowMultiple" => true,
            "maxFiles" => 3,
             "minFiles" => 2,
            "imagePreviewHeight" => 170,
            "imageCropAspectRatio" => "1:1",
            "imageResizeTargetWidth" => 200,
            "imageResizeTargetHeight" => 200,
            "allowFileSizeValidation" => true,
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande.",
            "labelMaxFileSize" => "El tamaño máximo permitido es de {filesize}",
        ],
        [
            "name" => 'svg',
            "acceptedFileTypes" => ["image/svg+xml"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona svg",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "chunkSize" => 1000000,
            "allowMultiple" => false, //default
            "maxFiles" => 1, //default if allowMultiple is set to false
            "imagePreviewHeight" => 170,
            "imageCropAspectRatio" => "1:1",
            "imageResizeTargetWidth" => 200,
            "imageResizeTargetHeight" => 200,
        ],
        [
            "name" => 'video',
            "acceptedFileTypes" => ["video/mp4"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona mp4",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "chunkSize" => 1000000,
            "allowMultiple" => true,
            "maxFiles" => 1,
          "allowFileSizeValidation" => true,
            "maxFileSize" => "10MB",
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande",
            "labelMaxFileSize" => "El tamaño máximo permitido es {filesize}",
        ],
        [
            "name" => "pdf",
            "acceptedFileTypes" => ["application/pdf"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona pdf",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "chunkSize" => 1000000,
            "allowMultiple" => true,
            "maxFiles" => 2,
            "allowPdfPreview" => true,
            "pdfPreviewHeight" => 200,
            "allowFileSizeValidation" => true,
            "maxFileSize" => "2MB",
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande",
            "labelMaxFileSize" => "El tamaño máximo permitido es {filesize}",
        ]
    ];
    protected $validation = [
        "chunkValidation" => [
            "chunkSize" => 100000, // in bytes
            "image" => [
                "beforeUpload" => "max_size[2000]",
                "afterUpload" => "max_dims[3000,3000]|is_image[]|mime_in[image/jpg,image/png,image/jpeg]|ext_in[jpg,png,jpeg]",
            ],
        ],
        "validationRules" => [
            "image" => "max_size[image,2000]|mime_in[image,image/jpg,image/png,image/jpeg]|ext_in[image,jpg,png,jpeg]|is_image[image]|max_dims[image,300,300]",
        ],
        "messages" => [
            "image" => [
                "max_dims" => "Dimensiones de imagen no válidas",
                "mime_in" => "Tipo inválido",
                "max_size" => "El archivo es demasiado grande",
                "ext_in" => "Ingresa un archivo válido",
                "is_image" => "El archivo no es una imagen",
            ],
        ],
    ];
    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();
        return view("admin/test/testFiles", ["tests" => $tests]);
    }
    public function viewTestFilesCreate()
    {
        session()->set("fileValidation", $this->validation);
        return view('admin/test/testFilesCreate', ["config" => $this->configFiles]);
    }
    public function createTestFiles()
    {
        $data = $this->request->getPost();

        $testModel = new TestModel();
        $testModel->insert(["testName" => $data["name"]]);
        $testId = $testModel->getInsertID();

        // Save Images
        if ($data['image']) {

            $array = [];
            foreach($data["image"] as $keyfile) {

                $folderId = FileManager::getFolderId();
                $outputFolder = $this->folderUpload . "$folderId/";
                FileManager::createFolder($outputFolder);

                $actualFolder = $this->folderTemp . $keyfile;
                $filePath = scandir($actualFolder)[2];

                $folderData = [
                    "fileRoute" => "$outputFolder/$filePath",
                    "uuid" => $folderId,
                    "fileDirectoryRoute" => $outputFolder,
                    "fileName" => $filePath
                ];
                $testFileModel = new TestFilesModel();
                $testFileModel->createNewFile($folderData, $testId, "image");

                FileManager::changeFileDirectory("$actualFolder/$filePath", $outputFolder);
                if(FileManager::isEmptyFolder($actualFolder)) {
                    FileManager::deleteEmptyFolder($actualFolder);
                }
            }
        }

        return redirect("admin/testFiles");
    }
    public function viewTestFilesEdit($id)
    {
        // session()->set("validation", $this->validation);
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];
        $files = $testModel->getKeyFiles($id);
        foreach($files as $file) {
            if($file["fileType"] === "image") {
                $this->configFiles[0]['files'][] = [
                    "source" => $file['uuid'],
                    "options" => [
                        "type" => "local"
                    ],
                ];
            }
            if($file["fileType"] === "svg") {
                $this->configFiles[1]['files'][] = [
                    "source" => $file['uuid'],
                    "options" => [
                        "type" => "local"
                    ],
                ];
            }
            if($file["fileType"] === "video") {
                $this->configFiles[2]['files'][] = [
                    "source" => $file['uuid'],
                    "options" => [
                        "type" => "local"
                    ],
                ];
            }
            if($file["fileType"] === "pdf") {
                $this->configFiles[3]['files'][] = [
                    "source" => $file['uuid'],
                    "options" => [
                        "type" => "local"
                    ],
                ];
            }
        }

        return view('admin/test/testFilesEdit', [
            "name" => $name,
            "config" => $this->configFiles,
        ]);
    }
    public function updateTestFiles($id)
    {
        $files = $this->request->getPost();
        $testModel = new TestModel();
        $actualImages = array_map(function ($file) {return $file["uuid"];}, $testModel->getKeyFiles($id));
        $newImages = array_diff($files["image"], $actualImages);
        $deleteImages = $files["delete-image"] ?? [];

        // Save Images
        if ($newImages) {
            foreach($newImages as $keyfile) {
                $folderId = FileManager::getFolderId();
                $outputFolder = "./uploads/$folderId/";
                FileManager::createFolder($outputFolder);

                $actualFolder = $this->folderTemp . $keyfile;
                $filePath = scandir($actualFolder)[2];

                $folderData = [
                    "fileRoute" => "$outputFolder/$filePath",
                    "uuid" => $folderId,
                    "fileDirectoryRoute" => $outputFolder,
                    "fileName" => $filePath
                ];
                $testFileModel = new TestFilesModel();
                $testFileModel->createNewFile($folderData, $id, "image");

                FileManager::changeFileDirectory("$actualFolder/$filePath", $outputFolder);
                if(FileManager::isEmptyFolder($actualFolder)) {
                    FileManager::deleteEmptyFolder($actualFolder);
                }
            }
        }
        if($deleteImages) {
            $fileModel = new FileModel();
            foreach ($deleteImages as $keyfile) {
                $fileFolder = $this->folderUpload . $keyfile . "/";
                $fileModel->where("uuid", $keyfile)->delete();
                FileManager::deleteFolderWithContent($fileFolder);
            }
        }
        return redirect("admin/testFiles");
    }
    public function deleteTestFiles()
    {
        echo "borrando test";
    }
}