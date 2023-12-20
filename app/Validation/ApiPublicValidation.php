<?php

namespace App\Validation;

class ApiPublicValidation extends BaseValidation
{
    protected $validationRules = [
        'categorias'     => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
        'producto-tags'  => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
        'categoria-tags' => 'if_exist|regex_match[^(?:[^,]+(?:,[^,]+)*)?$]',
        'por-pagina'     => 'required|integer',
        'pagina'         => 'required|integer',
        'clasificacion'  => 'if_exist|regex_match[^(?:id|name)?$]',
        'orden'          => 'if_exist|regex_match[^(?:asc|des)?$]',
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
        'por-pagina' => [
            'required' => 'por-pagina es requerido',
            'integer'  => 'por-pagina no es un entero',
        ],
        'pagina' => [
            'required' => 'pagina es requerido',
            'integer'  => 'pagina no es un entero',
        ],
        'clasificacion' => [
            'regex_match' => 'se acepta id o name',
        ],
        'orden' => [
            'regex_match' => 'se acepta asc o des',
        ],
    ];
}
