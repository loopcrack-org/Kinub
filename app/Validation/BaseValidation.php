<?php

namespace App\Validation;

class BaseValidation
{
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $errors             = [];

    public function validateInputs($data): bool
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->validationRules, $this->validationMessages);

        if (! $validation->run($data)) {
            $this->errors = $validation->getErrors();

            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Return the error by input name
     *
     * @param string $inputName the input name from post
     */
    public function getError(string $inputName): string
    {
        return $this->errors[$inputName];
    }

    /**
     * Add rules and custom messages to validation
     *
     * @param array $rules    the validation rules
     * @param array $messages the custom messages
     */
    public function addRules(array $rules, array $messages)
    {
        $this->validationRules    = array_merge($this->validationRules, $rules);
        $this->validationMessages = array_merge($this->validationMessages, $messages);
    }
}
