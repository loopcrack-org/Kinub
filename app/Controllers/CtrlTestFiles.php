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
        $this->config['image'] = FilesConfig::builder('image')->isImage()->minFiles(1)->maxFiles(3)->maxSize(3000)->build();
        $this->config['svg'] = FilesConfig::builder('svg')->isSvg()->minFiles(1)->maxFiles(3)->maxSize(3000)->build();
        $this->config['pdf'] = FilesConfig::builder('pdf')->isPDF()->minFiles(1)->maxFiles(3)->maxSize(3000)->build();
        $this->config['video'] = FilesConfig::builder('video')->isVideo()->minFiles(1)->maxFiles(3)->maxSize(3000)->build();
    }

    protected $validation = [
        "validationRules" => [
            "chunkSize" => 100000, // in bytes
            "image" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "rules" => "max_size[200]|max_dims[3000,3000]|is_image[]|mime_in[image/jpg,image/png,image/jpeg]|ext_in[jpg,png,jpeg]",
            ],
            "svg" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200]",
                "rules" => "max_size[200]|is_image[]|mime_in[image/svg+xml]|ext_in[svg]"
            ],
            "video" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200000]",
                "rules" => "max_size[200000]|mime_in[video/mp4]|ext_in[mp4]",
            ],
            "pdf" => [
                "collection" => "maxFiles[2]|minFiles[1]",
                "beforeUpload" => "max_size[200]",
                "rules" => "max_size[200]|mime_in[application/pdf]|ext_in[pdf]",
            ]
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
        return view('admin/test/testFilesCreate', ["config" => FilepondManager::getFilepondConfig($this->config)]);
    }
    public function createTestFiles()
    {
        $data = $this->request->getPost();
        $testModel = new TestModel();
        $inputFiles = ["image", "svg", "video", "pdf"];
        $validationErrors = [];
        foreach ($inputFiles as $i => $inputName) {
            $collection = empty($data[$inputName][0]) ? [] : $data[$inputName];
            // if(session()->has("fileValidation")) {
            //     $validation = session()->get("fileValidation");
            // }
            try {
                if(isset($this->validation)) {
                    //$this->configFiles[$i]["files"] = FilePondManager::getSourceFiles($collection, "limbo");
                    $rules = $this->validation["customValidationRules"][$inputName]["collection"];
                    $messages = $this->validation["messages"][$inputName] ?? [];
                    Services::fileValidation($rules, $messages)->run($collection);
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
                $collection = empty($data[$inputName][0]) ? [] : $data[$inputName];
                foreach($collection as $keyfile) {
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
                ->withInput();
            /*                 ->with("Test_filepondConfig", $this->configFiles)
                            ->with("Test_validationError", $validationErrors); */
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
            //$this->configFiles[$i]["files"] = FilepondManager::getSourceFiles($files, "local");
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
