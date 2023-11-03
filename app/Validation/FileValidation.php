<?php

namespace App\Validation;

use App\Classes\FileValidationBuilder;
use App\Exceptions\FileValidationException;
use CodeIgniter\Files\File;
use Config\Services;

class FileValidation
{
    private $validationFile;
    private $validationCollectionFiles;
    private String $error = "";

    public function __construct(FileValidationBuilder $fileValidationBuilder)
    {
        $this->validationFile = $fileValidationBuilder->validationFile();
        $this->validationCollectionFiles = $fileValidationBuilder->validationCollectionFiles();
    }

    public static function builder()
    {
        return new FileValidationBuilder();
    }

    public function validateFile(File $file): bool|FileValidationException
    {
        $validation = Services::FileValidation($this->validationFile['rules'], $this->validationFile['messages']);
        $validation->run($file);
        return true;
    }

    public function validateCollectionFiles(array $files): bool
    {
        try {
            $validation = Services::FileValidation($this->validationCollectionFiles['rules'], $this->validationCollectionFiles['messages']);
            $validation->run($files);
        } catch (FileValidationException $th) {
            $this->error = $th->getMessage();
            return false;
        }
        return true;
    }

    public function getError(): String
    {
        return $this->error;
    }

}
