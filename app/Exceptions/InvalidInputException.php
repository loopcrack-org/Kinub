<?php

namespace App\Exceptions;

use Exception;

class InvalidInputException extends Exception
{
    private array $errors;

    public function __construct(array $errors = [], string $message = '')
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
