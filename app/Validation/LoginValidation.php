<?php

namespace App\Validation;

use App\Models\UserModel;

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

    public function validateCredentials($email, $password) {
        $userModel = new UserModel();
        $user = $userModel->where("email", $email)->findAll(1)[0] ?? false;
        if($user) {
            if($email == $user["email"]) {
                if(password_verify($password, $user["password"])) {
                    return $user;
                }
            }
        }
        $this->errors = [
            "credentials" => $this->invalid_credentials_message,
        ];
        return false;
    }
}
