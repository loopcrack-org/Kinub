<?php

namespace App\Validation;

use App\Models\UserTokenModel;
use DateTime;
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
    private $userWithToken;

    public function __construct($userWithToken)
    {
        $this->userWithToken = $userWithToken;
    }

    public function existUserWithToken()
    {
        if (! $this->userWithToken) {
            throw new Exception('Lo sentimos, el token proporcionado no es válido o no existe. Por favor, verifica la información e intenta nuevamente');
        }

        return true;
    }

    public function validateTokenExpiration($token)
    {
        $userTokenModelo = new UserTokenModel();

        $tokenExpiryDate = $userTokenModelo->getTokenDate($token);
        $today           = new DateTime();

        if ($today >= $tokenExpiryDate) {
            $responseDelete = $userTokenModelo->deleteToken($this->userWithToken['userId']);

            if (! $responseDelete) {
                throw new Exception('Lo sentimos, ha ocurrido un error inesperado. Por favor, inténtalo de nuevo.');
            }

            throw new Exception('El token ha expirado. Por favor, solicita uno nuevo para continuar con la operación.');
        }

        return true;
    }

    public function hasAccessToResetPassword()
    {
        if ($this->userWithToken['confirmed'] === USER_IS_NOT_CONFIRMED) {
            throw new Exception('Parece que no cuenta con el permiso para restablecer su contraseña');
        }

        return true;
    }

    public function hasAccessToSetPassword()
    {
        if ($this->userWithToken['confirmed'] === USER_IS_CONFIRMED) {
            throw new Exception('Parece que no cuenta con el permiso para establecer su contraseña');
        }

        return true;
    }
}
