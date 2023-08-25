<?php

namespace App\Validation;

class ContactEmailValidation
{
    private $validationRules = [
        "product-name" => "required",
        "inquirer-name" => "required|alpha_space",
        "inquirer-email" => "required|valid_emails",
        "message" => "required"
    ];

    private $validateMessage = [
        "product-name" => [
            "required" => "El nombre del producto es obligatorio"
        ],
        "inquirer-name" => [
            "required" => "El nombre del solicitante es obligatorio",
            "alpha_space" => "El campo nombre solo debe contener carácteres alfabéticos y espacios"
        ],
        "inquirer-email" => [
            "required" => "El email es obligatorio",
            "valid_emails" => "El email debe contar con un formato valido"
        ],
        "message" => [
            "required" => "El mensaje es obligatorio",
        ],
    ];

    private $errors = [];

    public function validateData($data): bool
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->validationRules, $this->validateMessage);

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
