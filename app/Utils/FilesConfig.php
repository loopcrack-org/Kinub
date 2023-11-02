<?php

namespace App\Utils;

use App\Validation\FileCollectionValidation;
use App\Validation\FileValidation;

class FilesConfig
{
    private array $filepondConfig;
    private array $validationConfig;
    private array $validationCollectionConfig;
    private $inputName;

    public function __construct(FileponBuilder $filesConfigBuilder)
    {
        $this->inputName = $filesConfigBuilder->inputName();
        $this->filepondConfig = $filesConfigBuilder->filePondConfig();
        $this->validationConfig = $filesConfigBuilder->validationConfig();
        $this->validationCollectionConfig = $filesConfigBuilder->validationCollectionConfig();
    }

    public static function builder(String $inputName)
    {
        return new FileponBuilder($inputName);
    }

    public function setFiles(array $files)
    {
        $this->filepondConfig['files'] = $files;
    }

    public function getFilepondConfig()
    {
        return $this->filepondConfig;
    }

    public function getValidationConfig()
    {
        return new FileValidation($this->validationConfig["rules"], $this->validationConfig["messages"]);
    }

    public function getValidationCollectionConfig()
    {
        return new FileCollectionValidation($this->validationCollectionConfig["rules"], $this->validationCollectionConfig["messages"]);
    }

    public function getInputName()
    {
        return $this->inputName;
    }
}

class FileponBuilder
{
    private $mimeTypes = [
        'image' => ["image/jpg", "image/png", "image/jpeg"],
        'svg' => ["image/svg+xml"],
        'video' => ["video/mp4"],
        'pdf' => ["application/pdf"]
    ];

    private $inputTypes = [
        "image" => [
            "imagePreviewHeight" => 170,
            "imageCropAspectRatio" => "1:1",
            "imageResizeTargetWidth" => 200,
            "imageResizeTargetHeight" => 200,
        ],
        "pdf" => [
            "allowPdfPreview" => true,
            "pdfPreviewHeight" => 200,
        ],
        "video" => [
            "allowVideoPreview" => true,
            "allowAudioPreview" => true
        ]
    ];

    private $filepondConfig = [
        "labelFileTypeNotAllowed" => "Archivo no válido",
        "allowMultiple" => false,
        "allowFileSizeValidation" => true,
        "labelMaxFileSize" => "El tamaño máximo permitido es de {filesize}",
        "minFiles" => 1,
        "chunkUploads" => true,
        "chunkSize" => 1000000,
        "allowMultiple" => true,
    ];
    private $validationConfig = [
        "rules" => "",
        "messages" => [],
    ];
    private $validationCollectionConfig = [
        "rules" => "",
        "messages" => [],
    ];

    private $inputName;

    public function __construct(String $inputName)
    {
        $this->inputName = $inputName;
        $this->filepondConfig['name'] = $inputName;
    }

    public function build()
    {
        $this->validationConfig["rules"] = trim($this->validationConfig["rules"], "|");
        $this->validationCollectionConfig["rules"] = trim($this->validationCollectionConfig["rules"], "|");
        return new FilesConfig($this);
    }

    public function isImage()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['image'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['image']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo jpg, jpeg o png";

        $types = implode(",", $this->mimeTypes["image"]);
        $this->validationConfig["rules"] .= "mimeIn[$types]|";
        $this->validationConfig["messages"]["mimeIn"] = "El archivo no es una imagen";

        return $this;
    }
    public function isSvg()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['svg'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['image']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo svg";

        $types = implode(",", $this->mimeTypes["svg"]);
        $this->validationConfig["rules"] .= "mimeIn[$types]|";
        $this->validationConfig["messages"]["mimeIn"] = "El archivo no es un svg";

        return $this;
    }

    public function isPDF()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['pdf'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['pdf']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo PDF";

        $types = implode(",", $this->mimeTypes["pdf"]);
        $this->validationConfig["rules"] .= "mimeIn[$types]|";
        $this->validationConfig["messages"]["mimeIn"] = "El archivo no es un pdf";

        return $this;
    }

    public function isVideo()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['video'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['video']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo de video";

        $types = implode(",", $this->mimeTypes["video"]);
        $this->validationConfig["rules"] .= "mimeIn[$types]|";
        $this->validationConfig["messages"]["mimeIn"] = "El archivo no es un video";

        return $this;
    }

    public function chunkSize(int $chunkSize)
    {
        $this->filepondConfig["chunkSize"] = $chunkSize;
        return $this;
    }

    public function maxSize(int $maxSize)
    {
        $this->filepondConfig["maxFileSize"] = ($maxSize / 1000) . "MB";
        $this->filepondConfig["labelMaxFileSize"] = "El tamaño máximo permitido es de {filesize}";

        $this->validationConfig["rules"] .= "maxSize[$maxSize]|";
        $this->validationConfig["messages"]["maxSize"] = "El tamaño del archivo es demasiado grande";

        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->filepondConfig["allowMultiple"] = $maxFiles > 1;
        $this->filepondConfig["maxFiles"] = $maxFiles;

        $this->validationCollectionConfig["rules"] .= "maxFiles[$maxFiles]|";
        $this->validationCollectionConfig["messages"]["maxFiles"] = $maxFiles > 1 ? "Se aceptan como máximo $maxFiles archivos" : "Se acepta como máximo 1 archivo";

        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->filepondConfig["minFiles"] = $minFiles;

        $this->validationCollectionConfig["rules"] .= "minFiles[$minFiles]|";
        $this->validationCollectionConfig["messages"]["minFiles"] = $minFiles > 1 ? "Se aceptan como mínimo $minFiles archivos" : "Se acepta como mínimo 1 archivo";

        return $this;
    }

    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->filepondConfig["imageValidateSizeMaxWidth"] = $maxWidth;
        $this->filepondConfig["imageValidateSizeMaxHeight"] = $maxHeight;
        $this->validationConfig["rules"] .= "maxDims[$maxWidth, $maxHeight]|";
        $this->validationConfig["messages"]["minFiles"] = "El archivo debe ser de $maxWidth por $maxHeight pixeles";

        return $this;
    }

    public function filePondConfig(): array
    {
        return $this->filepondConfig;
    }
    public function validationConfig(): array
    {
        return $this->validationConfig;
    }
    public function validationCollectionConfig()
    {
        return $this->validationCollectionConfig;
    }
    public function inputName()
    {
        return $this->inputName;
    }
}
