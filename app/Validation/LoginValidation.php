<?php

namespace App\Validation;

use App\Models\UserModel;
use Exception;

class LoginValidation extends BaseValidation
{
    protected $validationRules = [
        "email" => "required|valid_emails",
        "password" => "required"
    ];

    protected $validationMessages = [
        "email" => [
            "required" => "El email es obligatorio",
            "valid_emails" => "Ingresa un email válido",
        ],
        "password" => [
            "required" => "La contraseña es obligatoria",
        ]
    ];

    protected $invalid_credentials_message = "Email o contraseña inválidos";

    public function validateCredentials($user, $password) {
        if(!$user || !password_verify($password, $user["userPassword"])) {
            $this->errors = [
                "credentials" => $this->invalid_credentials_message,
            ];

            throw new Exception();
        }
        return true;
    }
}
