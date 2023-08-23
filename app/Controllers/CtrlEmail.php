<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        $validationRules = [
            "product-name" => "required",
            "inquirer-name" => "required|alpha_space",
            "inquirer-email" => "required|valid_emails",
            "message" => "required"
        ];
        $validateMessage = [
            "product-name" => [
                "required" => "El nombre del producto es obligatorio"
            ],
            "inquirer-name" => [
                "required" => "El nombre del solicitante es obligatorio",
                "alpha_space" => "El campo nombre solo debe contener carácteres alfanuméricos y espacios"
            ],
            "inquirer-email" => [
                "required" => "El email es obligatorio",
                "valid_emails" => "El email debe contar con un formato valido"
            ],
            "message" => [
                "required" => "El mensaje es obligatorio",
            ],
        ];

        if(!$this->validate([$validationRules, $validateMessage])){
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }
    }
}
