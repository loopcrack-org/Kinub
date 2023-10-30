<?php

namespace App\Utils;

class FilesConfig
{
    private array $filepondConfig;
    private array $validationConfig;

    public function __construct(FilesConfigBuilder $filesConfigBuilder)
    {
        $this->filepondConfig = $filesConfigBuilder->filePondConfig();
    }

    public static function builder(String $inputName)
    {
        return new FilesConfigBuilder($inputName);
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
        return $this->validationConfig;
    }
}

class FilesConfigBuilder
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

    public function __construct(String $inputName)
    {
        $this->filepondConfig['name'] = $inputName;
    }

    public function build()
    {
        return new FilesConfig($this);
    }

    public function isImage()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['image'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['image']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo jpg, jpeg o png";
        return $this;
    }
    public function isSvg()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['svg'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['image']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo svg";
        return $this;
    }

    public function isPDF()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['pdf'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['pdf']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo PDF";
        return $this;
    }

    public function isVideo()
    {
        $this->filepondConfig["acceptedFileTypes"] = $this->mimeTypes['video'];
        $this->filepondConfig = array_merge($this->filepondConfig, $this->inputTypes['video']);
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = "Selecciona un archivo de video";
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
        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->filepondConfig["allowMultiple"] = $maxFiles > 1;
        $this->filepondConfig["maxFiles"] = $maxFiles;
        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->filepondConfig["minFiles"] = $minFiles;
        return $this;
    }

    public function filePondConfig()
    {
        return $this->filepondConfig;
    }
}
