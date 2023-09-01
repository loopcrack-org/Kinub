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
        // var_dump($password);
        // var_dump($user["password"]);
        // var_dump(password_verify($password, $user["password"]));
        // exit;
        if(!$user || !password_verify($password, $user["password"])) {
            $this->errors = [
                "credentials" => $this->invalid_credentials_message,
            ];

            throw new Exception();
        }
        return true;
    }
}
