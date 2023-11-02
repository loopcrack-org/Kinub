<?php

namespace App\Classes;

use App\Validation\FileValidation;

class FileConfig
{
    private FilepondConfig $filepondConfig;
    private FileValidation $fileValidation;
    private String $inputName;

    public function __construct(FilepondConfig $filepondConfig, FileValidation $fileValidation, string $inputName)
    {
        $this->filepondConfig = $filepondConfig;
        $this->fileValidation = $fileValidation;
        $this->inputName = $inputName;
    }

    public static function builder(String $inputName)
    {
        return new FileConfigBuilder(new FilepondConfigBuilder($inputName), new FileValidationBuilder(), $inputName);
    }

    public function getFileValidation(): FileValidation
    {
        return $this->fileValidation;
    }

    public function getFilepondConfig(): FilepondConfig
    {
        return $this->filepondConfig;
    }

    public function getInputName(): string
    {
        return $this->inputName;
    }


}
