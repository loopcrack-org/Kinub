<?php

namespace App\Validation;

/**
 * TEST - This validation is only for the CtrlTestFiles controller
 * declared its rules and custom messages
 */
class TestValidation extends BaseValidation
{
    protected $validationRules = [
        'name' => 'required',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Campo Obligatorio',
        ],
    ];
}
