<?php

namespace App\Validation;

use Exception;

class UserValidation extends BaseValidation
{
    protected $validationRules = [
        'userFirstName' => 'required|regex_match[^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s\']+$]',
        'userLastName'  => 'required|regex_match[^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s\']+$]',
        'userEmail'     => 'required|valid_emails',
    ];
    protected $validationMessages = [
        'userFirstName' => [
            'required'    => 'El nombre es obligatorio',
            'regex_match' => 'El campo nombre solo debe contener carácteres alfabéticos y espacios',
        ],
        'userLastName' => [
            'required'    => 'El apellido es obligatorio',
            'regex_match' => 'El campo nombre solo debe contener carácteres alfabéticos y espacios',
        ],
        'userEmail' => [
            'required'     => 'El email es obligatorio',
            'valid_emails' => 'El formato de email no es válido',
        ],
    ];

    public function existUserEmail($user)
    {
        if (! empty($user)) {
            $this->errors = [
                'userEmail' => 'El email ya se encuentra registrado. Por favor, introduzca un email diferente',
            ];

            throw new Exception();
        }

        return true;
    }
}
