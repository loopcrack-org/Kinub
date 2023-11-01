<?php
namespace App\Utils;

use App\Exceptions\FileValidationException;
use Config\Services;

class FileCollection {
    protected array $errors = [];

    public function validateCollectionFiles($data, $configs) {
        $errors = [];
        foreach ($configs as $config) {
            /** @var \App\Utils\FilesConfig $config*/
            $inputName = $config->getInputName();
            $keyFiles = empty($data[$inputName][0]) ? [] : $data[$inputName];
            $validation = $config->getValidationCollectionConfig();
            $validation->validate($keyFiles);
            if($validation->hasError()) {
                $errors[$inputName] = $validation->getError();
            }
        }
    }
    public function getErrors() {
        return $this->errors;
    }
    public function hasCollectionErrors() {
        return !empty($this->errors);
    }

}