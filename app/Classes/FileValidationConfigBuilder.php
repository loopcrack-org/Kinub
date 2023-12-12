<?php

namespace App\Classes;

use App\Interfaces\Filepond;
use App\Interfaces\ValidationConfigBuilder;

class FileValidationConfigBuilder implements ValidationConfigBuilder, Filepond
{
    private ClientValidationConfigBuilder|null $clientValidationConfigBuilder;
    private ServerValidationConfigBuilder|null $serverValidationConfigBuilder;
    private string $lastInputName;
    private array $config;
    private string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->config        = [];
        $this->baseUrl       = $baseUrl;
        $this->lastInputName = '';
    }

    public function builder(string $inputName)
    {
        $this->lastInputName                 = $inputName;
        $this->clientValidationConfigBuilder = ClientValidationConfig::builder($inputName);
        $this->serverValidationConfigBuilder = ServerValidationConfig::builder();

        return $this;
    }

    public function build()
    {
        if ($this->lastInputName !== '') {
            $this->config[$this->lastInputName] = [
                $this->clientValidationConfigBuilder->build(),
                $this->serverValidationConfigBuilder->build(),
            ];

            $this->reset();
        }
    }

    public function getConfig(): FileValidationConfig
    {
        return new FileValidationConfig($this->config, $this->baseUrl);
    }

    public function chunkSize(int $chunkSize)
    {
        $this->clientValidationConfigBuilder->chunkSize($chunkSize);

        return $this;
    }

    public function allowMultipleFiles()
    {
        $this->clientValidationConfigBuilder->allowMultipleFiles();

        return $this;
    }

    public function acceptTypesFile(array $fileExtensions)
    {
        $this->clientValidationConfigBuilder->acceptTypesFile($fileExtensions);
        $this->serverValidationConfigBuilder->acceptTypesFile($fileExtensions);

        return $this;
    }

    public function isImage()
    {
        $this->clientValidationConfigBuilder->isImage();
        $this->serverValidationConfigBuilder->isImage();

        return $this;
    }

    public function isPDF()
    {
        $this->clientValidationConfigBuilder->isPDF();
        $this->serverValidationConfigBuilder->isPDF();

        return $this;
    }

    public function isVideo()
    {
        $this->clientValidationConfigBuilder->isVideo();
        $this->serverValidationConfigBuilder->isVideo();

        return $this;
    }

    public function isSVG()
    {
        $this->clientValidationConfigBuilder->isSVG();
        $this->serverValidationConfigBuilder->isSVG();

        return $this;
    }

    public function maxSize(int $maxSize, string $unit)
    {
        $this->clientValidationConfigBuilder->maxSize($maxSize, $unit);
        $this->serverValidationConfigBuilder->maxSize($maxSize, $unit);

        return $this;
    }

    public function minSize(int $minSize, string $unit)
    {
        $this->clientValidationConfigBuilder->minSize($minSize, $unit);
        $this->serverValidationConfigBuilder->minSize($minSize, $unit);

        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->clientValidationConfigBuilder->maxFiles($maxFiles);
        $this->serverValidationConfigBuilder->maxFiles($maxFiles);

        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->clientValidationConfigBuilder->minFiles($minFiles);
        $this->serverValidationConfigBuilder->minFiles($minFiles);

        return $this;
    }

    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->clientValidationConfigBuilder->maxDims($maxWidth, $maxHeight);
        $this->serverValidationConfigBuilder->maxDims($maxWidth, $maxHeight);

        return $this;
    }

    private function reset()
    {
        $this->lastInputName                 = '';
        $this->clientValidationConfigBuilder = null;
        $this->serverValidationConfigBuilder = null;
    }
}
