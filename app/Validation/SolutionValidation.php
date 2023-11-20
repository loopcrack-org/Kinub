<?php

namespace App\Validation;

class SolutionValidation extends BaseValidation
{
    protected $validationRules = [
        'msName'        => 'required|regex_match[^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s\']+$]',
        'msDescription' => 'required',
    ];
    protected $validationMessages = [
        'msName' => [
            'required'    => 'Por favor, ingrese el titulo de la solución de medición',
            'regex_match' => 'El titulo de la solución de medición solo debe contener caracteres alfabéticos y espacios',
        ],
        'msDescription' => [
            'required' => 'Por favor, ingrese la descripción de la solución de medición',
        ],
    ];
}
