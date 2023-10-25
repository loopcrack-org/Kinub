<?php

namespace App\Exceptions;
use Exception;

class FileValidationException extends Exception {
    public function getFileValidationError() {
        return $this->getMessage();
    }
}