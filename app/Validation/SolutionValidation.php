<?php

namespace App\Validation;

class SolutionValidation extends BaseValidation
{
    protected $validationRules = [
        'msName'        => 'required',
        'msDescription' => 'required',
    ];
    protected $validationMessages = [
        'msName' => [
            'required'    => 'Por favor, ingrese el título de la solución de medición',
            'regex_match' => 'El título de la solución de medición solo debe contener caracteres alfabéticos y espacios',
        ],
        'msDescription' => [
            'required' => 'Por favor, ingrese la descripción de la solución de medición',
        ],
    ];
}
