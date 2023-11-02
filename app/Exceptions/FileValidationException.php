<?php

namespace App\Exceptions;

use Exception;

class FileValidationException extends Exception
{
    public function __construct(String|array $errorMessage)
    {
        parent::__construct($errorMessage);
    }

}
