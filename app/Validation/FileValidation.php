<?php

namespace App\Validation;
use Config\Services;

class FileValidation
{
    protected string $rules;
    protected array $messages;
    public function __construct(string $rules, array $messages)
    {
        $this->rules = $rules;
        $this->messages = $messages;
    }
    public function validate($file) {
        $validation = Services::FileValidation($this->rules, $this->messages);
        $validation->run($file);
        return true;
    }
}
