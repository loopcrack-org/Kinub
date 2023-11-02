<?php

namespace App\Classes;

use App\Interfaces\FileBuilder;

class FileConfigBuilder implements FileBuilder
{
    private FilepondConfigBuilder $filepondConfigBuilder;
    private FileValidationBuilder $fileValidationBuilder;
    private String $inputName;

    public function __construct(
        FilepondConfigBuilder $filepondConfigBuilder,
        FileValidationBuilder $fileValidationBuilder,
        String $inputName
    ) {
        $this->filepondConfigBuilder = $filepondConfigBuilder;
        $this->fileValidationBuilder = $fileValidationBuilder;
        $this->inputName = $inputName;
    }

    public function build()
    {
        return new FileConfig($this->filepondConfigBuilder->build(), $this->fileValidationBuilder->build(), $this->inputName);
    }

    public function previewImage()
    {
        $this->filepondConfigBuilder->previewImage();
        return $this;
    }

    public function previewVideo()
    {
        $this->filepondConfigBuilder->previewVideo();
        return $this;
    }

    public function previewPDF()
    {
        $this->filepondConfigBuilder->previewPDF();
        return $this;
    }

    public function chunkSize(int $chunkSize)
    {
        $this->filepondConfigBuilder->chunkSize($chunkSize);
        return $this;
    }
    public function allowMultipleFiles()
    {
        $this->filepondConfigBuilder->allowMultipleFiles();
        return $this;
    }
    public function acceptTypesFile(array $mimeTypes, String $labelExpectedTypes)
    {
        $this->filepondConfigBuilder->acceptTypesFile($mimeTypes, $labelExpectedTypes);
        $this->fileValidationBuilder->acceptTypesFile($mimeTypes, $labelExpectedTypes);

        return $this;
    }
    public function maxSize(int $maxSize)
    {
        $this->filepondConfigBuilder->maxSize($maxSize);
        $this->fileValidationBuilder->maxSize($maxSize);
        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->filepondConfigBuilder->maxFiles($maxFiles);
        $this->fileValidationBuilder->maxFiles($maxFiles);
        return $this;
    }
    public function minFiles(int $minFiles)
    {
        $this->filepondConfigBuilder->minFiles($minFiles);
        $this->fileValidationBuilder->minFiles($minFiles);
        return $this;
    }
    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->filepondConfigBuilder->maxDims($maxWidth, $maxHeight);
        $this->fileValidationBuilder->maxDims($maxWidth, $maxHeight);
        return $this;
    }
}
