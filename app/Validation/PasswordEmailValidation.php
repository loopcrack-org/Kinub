<?php

namespace App\Validation;

use Exception;

class PasswordEmailValidation extends BaseValidation
{
    protected $validationRules = [
        'email' => 'required|valid_emails',
    ];
    protected $validationMessages = [
        'email' => [
            'required'     => 'El email es obligatorio',
            'valid_emails' => 'El formato de email no es válido',
        ],
    ];

    public function existUserWithEmail($user)
    {
        if (! $user) {
            $this->errors['email'] = 'No existe algun usuario con el email ingresado';

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

    public function validateConfirmedAccount($isConfirmed)
    {
        if ($isConfirmed === '0') {
            throw new Exception('Tu cuenta no ha sido confirmada. Por favor, revisa tu correo electrónico para finalizar el proceso de confirmación de tu cuenta.');
        }

        return true;
    }
}
