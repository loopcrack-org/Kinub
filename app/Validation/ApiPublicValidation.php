<?php

namespace App\Validation;

class ApiPublicValidation extends BaseValidation
{
    protected $validationRules = [
        'categorias'     => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
        'producto-tags'  => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
        'categoria-tags' => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
    ];
    protected $validationMessages = [
        'categorias' => [
            'regex_match' => 'categorias inválidas',
        ],
        'producto-tags' => [
            'regex_match' => 'tags de producto inválidos',
        ],
        'categoria-tags' => [
            'regex_match' => 'tags de categoría inválidos',
        ],
    ];
}
