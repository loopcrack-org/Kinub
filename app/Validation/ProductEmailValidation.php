<?php

namespace App\Validation;

class ProductEmailValidation extends BaseValidation
{
    protected $validationRules = [
        'product-name'   => 'required',
        'product-model'  => 'required',
        'inquirer-name'  => 'required|alpha_space',
        'inquirer-email' => 'required|valid_emails',
        'inquirer-phone' => 'required|regex_match[/[1-9][0-9]{9}/]',
        'message'        => 'required',
    ];
    protected $validationMessages = [
        'product-name' => [
            'required' => 'El nombre del producto es obligatorio',
        ],
        'product-model' => [
            'required' => 'El modelo del producto es obligatorio',
        ],
        'inquirer-phone' => [
            'required'    => 'El teléfono de contacto es obligatorio',
            'regex_match' => 'Verifique que el número de teléfono tenga un formato válido',
        ],
        'inquirer-name' => [
            'required'    => 'El nombre del solicitante es obligatorio',
            'alpha_space' => 'El campo nombre solo debe contener carácteres alfabéticos y espacios',
        ],
        'inquirer-email' => [
            'required'     => 'El email es obligatorio',
            'valid_emails' => 'El email debe contar con un formato valido',
        ],
        'message' => [
            'required' => 'El mensaje es obligatorio',
        ],
    ];
}
