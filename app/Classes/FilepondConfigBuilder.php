<?php

namespace App\Classes;

use App\Interfaces\FileBuilder;

class FilepondConfigBuilder implements FileBuilder
{
    private array $filepondConfig = [
        "labelFileTypeNotAllowed" => "Archivo no válido",
        "allowMultiple" => false,
        "allowFileSizeValidation" => true,
        "chunkUploads" => true,
        "chunkSize" => 1000000,
    ];

    public function __construct(String $inputName)
    {
        $this->filepondConfig['name'] = $inputName;
    }

    public function build()
    {
        return new FilepondConfig($this);
    }

    public function previewImage()
    {
        $this->filepondConfig["imagePreviewHeight"] = 170;
        $this->filepondConfig["imageCropAspectRatio"] = "1:1";
        $this->filepondConfig["imageResizeTargetWidth"] = 200;
        $this->filepondConfig["imageResizeTargetHeight"] = 200;
        return $this;
    }

    public function previewVideo()
    {
        $this->filepondConfig["allowVideoPreview"] = true;
        $this->filepondConfig["allowAudioPreview"] = true;
        return $this;
    }

    public function previewPDF()
    {
        $this->filepondConfig["allowPdfPreview"] = true;
        $this->filepondConfig["pdfPreviewHeight"] = 200;
        return $this;
    }

    public function chunkSize(int $chunkSize)
    {
        $this->filepondConfig["chunkSize"] = $chunkSize;
        return $this;
    }
    public function allowMultipleFiles()
    {
        $this->filepondConfig['allowMultiple'] = true;
        return $this;
    }


    public function acceptTypesFile(array $mimeTypes, String $labelExpectedTypes)
    {
        $this->filepondConfig["acceptedFileTypes"] = $mimeTypes;
        $this->filepondConfig["fileValidateTypeLabelExpectedTypes"] = $labelExpectedTypes;
        return $this;
    }

    public function maxSize(int $maxSize)
    {

        $this->filepondConfig["maxFileSize"] = ceil((float) $maxSize / 1000) . "MB";
        $this->filepondConfig["labelMaxFileSizeExceeded"] = "El archivo es demasiado grande.";
        $this->filepondConfig["labelMaxFileSize"] = "El tamaño máximo permitido es de {filesize}";
        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->filepondConfig["maxFiles"] = $maxFiles;
        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->filepondConfig["minFiles"] = $minFiles;
        return $this;
    }

    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->filepondConfig["imageValidateSizeMaxWidth"] = $maxWidth;
        $this->filepondConfig["imageValidateSizeMaxHeight"] = $maxHeight;
        return $this;
    }

    public function filepondConfig()
    {
        return $this->filepondConfig;
    }
}
