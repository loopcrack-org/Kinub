<?php

namespace App\Validation;

class BaseValidation
{
    protected $validationRules = [];

    protected $validationMessages = [];

    protected $errors = [];

    public function validateInputs($data): bool
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->validationRules, $this->validationMessages);

        if(!$validation->run($data)){
            $this->errors = $validation->getErrors();
            return false;
        }
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
