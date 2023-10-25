<?php

namespace App\Validation;

class UserValidation extends BaseValidation
{
    protected $validationRules = [
        'userFirstName' => 'required|alpha_space',
        'userLastName'  => 'required|alpha_space',
        'userEmail'     => 'required|valid_emails|is_unique[users.userEmail]"',
    ];
    protected $validationMessages = [
        'userFirstName' => [
            'required'    => 'El nombre es obligatorio',
            'alpha_space' => 'El campo nombre solo debe contener carácteres alfabéticos y espacios',
        ],
        'userLastName' => [
            'required'    => 'El apellido es obligatorio',
            'alpha_space' => 'El campo nombre solo debe contener carácteres alfabéticos y espacios',
        ],
        'userEmail' => [
            'required'     => 'El email es obligatorio',
            'valid_emails' => 'El formato de email no es válido',
            'is_unique'    => 'El email ya se encuentra registrado. Por favor, introduzca un email diferente',
        ],
    ];
}
