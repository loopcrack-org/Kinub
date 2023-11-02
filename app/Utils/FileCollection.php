<?php

namespace App\Utils;

use App\Exceptions\FileValidationException;
use Config\Services;

class FileCollection
{
    protected array $errors = [];

    public function validateCollectionFiles($data, $configs)
    {
        $errors = [];
        foreach ($configs as $key => $config) {
            $inputName = $key;
            $keyFiles = empty($data[$inputName][0]) ? [] : $data[$inputName];
            $fileValidation = $config->getFileValidation();
            $hasError = $fileValidation->validateCollectionFiles($keyFiles);
            if($hasError) {
                $errors[$inputName] = $fileValidation->getError();
            }
        }
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function hasCollectionErrors()
    {
        return !empty($this->errors);
    }

}
