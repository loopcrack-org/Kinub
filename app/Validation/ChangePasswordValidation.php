<?php

namespace App\Validation;

use Exception;

class ChangePasswordValidation extends BaseValidation
{
    protected $validationRules = [
        'password'         => 'required|min_length[8]|regex_match[(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,}]',
        'confirm-password' => 'matches[password]',
    ];
    protected $validationMessages = [
        'password' => [
            'required'    => 'La contraseña es obligatoria',
            'min_length'  => 'La contraseña debe tener al menos 8 caracteres',
            'regex_match' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número',
        ],
        'confirm-password' => [
            'matches' => 'Las contraseñas deben coincidir',
        ],
    ];
    protected $errors = [];

    public function existUserWithToken($user)
    {
        if (! $user) {
            $this->errors = [
                'connection' => 'Algo ha salido mal, porfavor recarga la página e intenta nuevamente',
            ];

            throw new Exception();
        }

        return true;
    }

    public function accessValidation($isConfirmed, $isAuthorized)
    {
        if ($isConfirmed !== $isAuthorized) {
            throw new Exception();
        }

        return true;
    }
}
