<?php

namespace App\Validation;

class CertificateValidation extends BaseValidation
{
    protected $validationRules = [
        'certificatefileName' => 'required|regex_match[^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s\'0-9]+$]',
    ];
    protected $validationMessages = [
        'certificatefileName' => [
            'required'    => 'El nombre del certificado es obligatorio',
            'regex_match' => 'El campo nombre solo debe contener carácteres alfanuméricos y espacios',
        ],
    ];
}
