<?php

namespace App\Validation;

class AboutUsValidation extends BaseValidation
{
    protected $validationRules = [
        'aboutUsTitle' => 'required|max_length[20]',
        'aboutUsText'  => 'required|max_length[330]',
    ];
    protected $validationMessages = [
        'aboutUsTitle' => [
            'required'   => 'El titulo es obligatoria.',
            'max_length' => 'Se ha excedido el límite de caracteres. Ingrese menos de 20 caracteres',
        ],
        'aboutUsText' => [
            'required'   => 'La descripción es obligatoria.',
            'max_length' => 'Se ha excedido el límite de caracteres. Ingrese menos de 330 caracteres',
        ],
    ];
}
