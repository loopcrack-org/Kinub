<?php

namespace App\Validation;

use Exception;

class PasswordEmailValidation extends BaseValidation
{
    protected $validationRules = [
        "email" => "required|valid_emails",
    ];

    protected $validationMessages = [
        "email" => [
            "required" => "El email es obligatorio",
            "valid_emails" => "El formato de email no es válido",
        ]
    ];


    public function existUserWithEmail($user)
    {
        if (!$user) {
            $this->errors['email'] = "No existe algun usuario con el email ingresado";
            throw new Exception();
        }

        return true;
    }

    public function isNotSuperAdmin($admin)
    {
        if ($admin) {
            throw new Exception('No cuenta con permisos para restablecer su contraseña, por favor contacte con los desarrolladores');
        }

        return true;
    }
}
