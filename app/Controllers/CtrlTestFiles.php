<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Exceptions\FileValidationException;
use App\Models\FileModel;
use App\Models\TestFilesModel;
use App\Models\TestModel;
use App\Utils\FileManager;
use App\Utils\FilePondManager;
use App\Validation\CustomFileValidation;

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
            // "maxFiles" => 3,
            // "minFiles" => 2,
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
            // "minFiles" => 1,
            // "maxFiles" => 1, //default if allowMultiple is set to false
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
            // "maxFiles" => 1,
            "allowFileSizeValidation" => true,
            "maxFileSize" => "10000000000000MB",
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
            // "maxFiles" => 2,
            "allowPdfPreview" => true,
            "pdfPreviewHeight" => 200,
            "allowFileSizeValidation" => true,
            "maxFileSize" => "2MB",
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande",
            "labelMaxFileSize" => "El tamaño máximo permitido es {filesize}",
        ]
    ];
    protected $validation = [
        "customValidationRules" => [
            "chunkSize" => 100000, // in bytes
            "image" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200]",
                "afterUpload" => "max_dims[3000,3000]|is_image[]|mime_in[image/jpg,image/png,image/jpeg]|ext_in[jpg,png,jpeg]",
            ],
            "svg" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200]",
                "afterUpload" => "is_image[]|mime_in[image/svg+xml]|ext_in[svg]"
            ],
            "video" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200000]",
                "afterUpload" => "mime_in[video/mp4]|ext_in[mp4]",
            ],
            "pdf" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200]",
                "afterUpload" => "mime_in[application/pdf]|ext_in[pdf]",
            ]
        ],
        "validationRules" => [
            "image" => "max_size[image,2000]|mime_in[image,image/jpg,image/png,image/jpeg]|ext_in[image,jpg,png,jpeg]|is_image[image]|max_dims[image,300,300]",
            "svg" => "max_size[svg,2000]|mime_in[svg,image/svg+xml]|ext_in[svg,svg]|is_image[svg]",
            "video" => "max_size[video,2000]|mime_in[video,video/mp4]|ext_in[video,mp4]",
            "pdf" => "max_size[pdf,2000]|mime_in[pdf,application/pdf]|ext_in[pdf,pdf]",
        ],
        "messages" => [
            "image" => [
                "max_dims" => "Dimensiones de imagen no válidas",
                "mime_in" => "Tipo de imagen inválida",
                "max_size" => "La imagen es demasiado grande",
                "ext_in" => "Ingresa una imagen con extensión válida",
                "is_image" => "El archivo no es una imagen",
                "maxFiles" => "Se permiten máximo 2 imagenes",
                "minFiles" => "Es necesario mínimo 1 imagen"
            ],
            "svg" => [
                "max_dims" => "Dimensiones del ícono no válidas",
                "mime_in" => "Tipo de ícono inválido",
                "max_size" => "El ícono es demasiado grande",
                "ext_in" => "Ingresa un icono con extensión válida",
                "is_image" => "El archivo no es una imagen",
                "maxFiles" => "Se permiten máximo 1 ícono",
                "minFiles" => "Es necesario mínimo 1 ícono"
            ],
            "video" => [
                "mime_in" => "Tipo de video inválido",
                "max_size" => "El video es demasiado grande",
                "ext_in" => "Ingresa un video con extensión válida",
                "maxFiles" => "Se permiten máximo 1 video",
                "minFiles" => "Es necesario mínimo 1 video"
            ],
            "pdf" => [
                "mime_in" => "Tipo de pdf inválido",
                "max_size" => "El pdf es demasiado grande",
                "ext_in" => "Ingresa un pdf con extensión válida",
                "maxFiles" => "Se permiten máximo 2 pdf",
                "minFiles" => "Es necesario mínimo 1 pdf"
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
        session()->set("fileValidation", $this->validation);
        return view('admin/test/testFilesCreate', ["config" => $this->configFiles]);
    }
    public function createTestFiles()
    {
        $data = $this->request->getPost();
        $testModel = new TestModel();
        $inputFiles = ["image", "svg", "video", "pdf"];
        $validationErrors = [];
        foreach ($inputFiles as $i => $inputName) {
            $collection = empty($data[$inputName][0]) ?  [] : $data[$inputName];
            // if(session()->has("fileValidation")) {
            //     $validation = session()->get("fileValidation");
            // }
            try {
                if(isset($this->validation)) {
                    $this->configFiles[$i]["files"] = FilePondManager::getSourceFiles($collection, "limbo");
                    $validationRules = $this->validation["customValidationRules"][$inputName]["collection"];
                    $messages = $this->validation["messages"][$inputName] ?? [];
                    $validation = new CustomFileValidation();
                    $validation->setRules($validationRules,$messages);
                    $validation->run($collection);
                }
            } catch (FileValidationException $th) {
                $validationErrors[$inputName] = $th->getFileValidationError();
                continue;
            }
        }
        if(empty($validationErrors)) {
            $testModel->insert(["testName" => $data["name"]]);
            $testId = $testModel->getInsertID();
            foreach ($inputFiles as $i => $inputName) {
                $collection = empty($data[$inputName][0]) ?  [] : $data[$inputName];
                foreach($collection as $keyfile) {
                        $outputFolder = $this->folderUpload . $keyfile;
                        $sourceFolder = $this->folderTemp . $keyfile;
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
                ->with("Test_filepondConfig", $this->configFiles)
                ->with("Test_validationError", $validationErrors);
        }

        return redirect("admin/testFiles");
    }
    public function viewTestFilesEdit($id)
    {
        // session()->set("validation", $this->validation);
        $testModel = new TestModel();
        $name = $testModel->select("testName")->where("testId", $id)->first()["testName"];
        $inputFiles = ["image", "svg", "video", "pdf"];
        foreach ($inputFiles as $i => $inputName) {
            $files = array_map(function ($file) {
                return $file["uuid"];
            }, $testModel->getKeyFilesByType($id, $inputName));
            $this->configFiles[$i]["files"] = FilepondManager::getSourceFiles($files, "local");
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
        $newImages = FilepondManager::getNewFilesInFilepond($files['image'], $testModel->getKeyFilesByType($id, "image"));
        $deleteImages = $files["delete-image"] ?? [];

        foreach($newImages as $keyfile) {
            $outputFolder = $this->folderUpload . $keyfile;
            $sourceFolder = $this->folderTemp . $keyfile;
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
            $fileFolder = $this->folderUpload . $keyfile . "/";
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
