<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;

class CtrlTestFiles extends BaseController
{
    private $folderTemp = "./files/tmp/";
    protected $configFiles = [
       [
            "name" => "image",
            "acceptedFileTypes" => ["image/jpg", "image/png", "image/jpeg"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona jpg, jpeg o png",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "chunkSize" => 1000000,
            "allowMultiple" => true,
            "maxFiles" => 3,
            "minFiles" => 2,
            "imagePreviewHeight" => 170,
            "imageCropAspectRatio" => "1:1",
            "imageResizeTargetWidth" => 200,
            "imageResizeTargetHeight" => 200,
            "allowFileSizeValidation" => true,
            "maxFileSize" => "3MB",
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande",
            "labelMaxFileSize" => "El tamaño máximo permitido es {filesize}",
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
        "image" => [
            "rulesValidation" => "max_size[image,2000]|mime_in[image,image/jpg,image/png,image/jpeg]|ext_in[image,jpg,png,jpeg]|is_image[image]",
            "messages" => [
                "max_size" => "El archivo es demasiado grande",
                "ext_in" => "Ingresa un archivo válido",
                "is_image" => "El archivo no es una imagen",
            ]
        ],
        "svg" => [
            "rulesValidation" => [
                ""
            ],
            "messages" => [
                ""
            ]
        ],
        "video" => [
            "rulesValidation" => [
                ""
            ],
            "messages" => [
                ""
            ]
        ],
        "pdf" => [
            "rulesValidation" => [
                ""
            ],
            "messages" => [
                ""
            ]
        ],
    ];
    public function viewTestFiles()
    {
        $tests = (new TestModel())->findAll();
        return view("admin/test/testFiles", ["tests" => $tests]);
    }
    public function viewTestFilesCreate()
    {
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
            foreach($data["image"] as $keyfile) {
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
        echo "actualizando test No. $id";
    }
    public function deleteTestFiles()
    {
        echo "borrando test";
    }
}
