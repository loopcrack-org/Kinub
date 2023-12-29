<?php

namespace App\Validation;

class AboutUsValidation extends BaseValidation
{
    protected $validationRules = [
        'aboutUsText' => 'required|max_length[450]',
    ];
    protected $validationMessages = [
        'aboutUsText' => [
            'required'   => 'La descripción es obligatoria.',
            'max_length' => 'Se ha excedido el límite de caracteres. Ingrese menos de 450 caracteres',
        ],
    ];
}
