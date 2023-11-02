<?php

namespace App\Utils;

class FileCollectionValidation
{
    protected array $errors = [];

    public function validateCollectionFiles($keyFiles, $configs)
    {
        foreach ($configs as $inputName => $config) {
            /** @var \App\Classes\FileConfig $config*/
            $fileValidation = $config->getFileValidation();
            $success = $fileValidation->validateCollectionFiles($keyFiles[$inputName]);
            if(!$success) {
                $this->errors[$inputName] = $fileValidation->getError();
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
