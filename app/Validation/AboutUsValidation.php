<?php

namespace App\Validation;

class AboutUsValidation extends BaseValidation
{
    protected $validationRules = [
        'aboutUsText' => 'required',
    ];
    protected $validationMessages = [
        'aboutUsText' => [
            'required' => 'La descripción es obligatoria.',
        ],
    ];
}
