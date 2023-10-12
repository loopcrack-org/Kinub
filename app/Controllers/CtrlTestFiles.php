<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;

class CtrlTestFiles extends BaseController
{
    private $folderTemp = "./files/tmp/";
    protected $configFiles = [
        "image" => [
            "acceptedFileTypes" => ["image/jpg", "image/png", "image/jpeg"],
            "fileValidateTypeLabelExpectedTypes" => "Selecciona jpg, jpeg o png",
            "chunkUploads" => true,
            "labelFileTypeNotAllowed" => "Archivo no válido",
            "chunkSize" => 1000000,
            "allowMultiple" => true,
            "maxFiles" => 3,
            "imagePreviewHeight" => 170,
            "imageCropAspectRatio" => "1:1",
            "imageResizeTargetWidth" => 200,
            "imageResizeTargetHeight" => 200,
            "allowFileSizeValidation" => true,
            "maxFileSize" => "3MB",
            "labelMaxFileSizeExceeded" => "El archivo es demasiado grande",
            "labelMaxFileSize" => "El tamaño máximo permitido es {filesize}",
        ],
        "svg" => [
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
        "video" => [
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
        "pdf" => [
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

    public function index()
    {
        $img = glob("./uploads/**/*.png");
        $video = glob("./uploads/**/*.mp4");
        $pdf = glob("./uploads/**/*.pdf");
        $svg = glob("./uploads/**/*.svg");

        $data = ["img" => $img, "video" => $video, "pdf" => $pdf, "svg" => $svg];

        return view('admin/test/testFiles', ['filesSaved' => $data, "config" => htmlspecialchars(json_encode($this->configFiles))]);
    }

    public function saveData()
    {
        $files = $this->request->getPost();
        $idFolder = md5(uniqid(rand(), true));
        $outputFolder = "./uploads/$idFolder/";
        FileManager::createFolder($outputFolder);


        // Save Images
        if ($files['image']) {
            foreach($files["image"] as $keyfile) {
                $actualFolder = $this->folderTemp . $keyfile;
                $filePath = glob("$actualFolder/*.*")[0];
                FileManager::changeFileDirectory($filePath, $outputFolder);
                if(FileManager::isEmptyFolder($actualFolder)) {
                    FileManager::deleteEmptyFolder($actualFolder);
                }
            }
        }
        // Save Other files
        if ($files['svg']) {
            FileManager::changeFileDirectory($files['svg'], $outputFolder);
        }

        if ($files['video']) {
            FileManager::changeFileDirectory($files['video'], $outputFolder);
        }

        if ($files['pdf']) {
            FileManager::changeFileDirectory($files['pdf'], $outputFolder);
        }

        return redirect("admin/testFiles");
    }
}
