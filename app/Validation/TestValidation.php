<?php

namespace App\Validation;

class TestValidation extends BaseValidation
{
    protected $validationRules = [
        'name' => "required"
    ];

    protected $validationMessages = [
        "name" => [
            "required" => "Campo Obligatorio",
        ]
    ];
}
