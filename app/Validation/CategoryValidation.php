<?php

namespace App\Validation;

class CategoryValidation extends BaseValidation
{
    protected $validationRules = [
        'categoryName' => 'required',
        'categoryTags' => 'required',
    ];
    protected $validationMessages = [
        'categoryName' => [
            'required' => 'El nombre de la categoría es obligatorio.',
        ],
        'categoryTags' => [
            'required' => 'Los tags de la categoría son obligatorios.',
        ],
    ];
}
