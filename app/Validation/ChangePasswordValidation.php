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
            throw new Exception('Lo sentimos, el token proporcionado no es válido o no existe. Por favor, verifica la información e intenta nuevamente');
        }

        return true;
    }

    public function accessValidation($isConfirmed, $isAuthorized)
    {
        if ($isConfirmed !== $isAuthorized) {
            $message = '';
            if ($isAuthorized) {
                $message = 'Parece que no cuenta con el permiso para restablecer su contraseña';
            } else {
                $message = 'Parece que no cuenta con el permiso para establecer su contraseña';
            }

            throw new Exception($message);
        }

        return true;
    }
}
