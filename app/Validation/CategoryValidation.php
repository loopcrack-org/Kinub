<?php

namespace App\Validation;

class CategoryValidation extends BaseValidation
{
    protected $validationRules = [
        'categoryName'    => 'required|max_length[20]',
        'categorySubname' => 'required|max_length[20]',
        'categoryTags'    => 'required',
    ];
    protected $validationMessages = [
        'categoryName' => [
            'required'   => 'El nombre de la categoría es obligatorio.',
            'max_length' => 'Se ha excedido el límite de caracteres. Ingrese menos de 20 caracteres',
        ],
        'categorySubname' => [
            'required'   => 'El subnombre de la categoría es obligatorio.',
            'max_length' => 'Se ha excedido el límite de caracteres. Ingrese menos de 20 caracteres',
        ],
        'categoryTags' => [
            'required' => 'Los tags de la categoría son obligatorios.',
        ],
    ];
}
