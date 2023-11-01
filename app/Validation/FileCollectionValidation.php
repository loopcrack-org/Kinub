<?php

namespace App\Validation;

use App\Exceptions\FileValidationException;
use App\Utils\FilesConfig;
use Config\Services;

class FileCollectionValidation
{
    protected string $rules;
    protected array $messages;
    protected string $error = "";
    public function __construct(string $rules, array $messages)
    {
        $this->rules = $rules;
        $this->messages = $messages;
    }
    public function validate($files) {
        try {
            $validation = Services::FileValidation($this->rules, $this->messages);
            $validation->run($files);
        } catch (FileValidationException $th) {
            $this->error = $th->getFileValidationError();
        }
    }
    public function hasError() {
        return !empty($this->error);
    }
    public function getError() {
        return $this->error;
    }
}