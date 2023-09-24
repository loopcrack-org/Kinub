<?php

namespace App\Validation;

class SupportEmailValidation
{
    private $validationRules = [
        "support-customer" => "required|alpha_space",
        "support-phone" => "required|regex_match[^(?:\+\d{1,3}\s?)?\d{10}$]",
        "support-email" => "required|valid_emails",
        "support-model" => "required",
        "support-serial" => "required",
        "support-problem-type" => "required",
        "support-problem" => "required",
    ];

    private $validateMessage = [
        "support-customer" => [
            "required" => "El nombre del cliente es obligatorio",
            "alpha_space" => "El campo nombre solo debe contener carácteres alfabéticos y espacios"
        ],
        "support-phone" => [
            "required" => "El teléfono es obligatorio",
            "regex_match" => "El campo teléfono debe contener 10 dígitos numéricos y puede incluir una lada opcional"
        ],
        "support-email" => [
            "required" => "El email es obligatorio",
            "valid_emails" => "El email debe contar con un formato valido"
        ],
        "support-model" => [
            "required" => "El modelo del producto es obligatorio",
        ],
        "support-serial" => [
            "required" => "El número de serie del producto es obligatorio",
        ],
        "support-problem-type" => [
            "required" => "El tipo de problema del producto es obligatorio",
        ],
        "support-problem" => [
            "required" => "El problema del producto es obligatorio",
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
