<?php

namespace App\Controllers;

use App\Validation\ContactEmailValidation;
use CodeIgniter\HTTP\RedirectResponse;

class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        $contactEmailValidation = new ContactEmailValidation();
        $POST = $this->request->getPost();

        if(!$contactEmailValidation->validateData($POST)){
            return redirect()->back()->withInput()->with("errors", $contactEmailValidation->getErrors());
        }

        $POST["subject"] = "Mensaje del formulario de contacto";
        $formData = [
            "product-name" => [
                "label" => "Producto",
                "output" => $POST["product-name"]
            ],
            "message" => [
                "label" => "Mensaje",
                "output" => $POST["message"]
            ]
        ];
        $senderName = [
            "label" => "Nombre del cliente",
            "output" => $POST["inquirer-name"]
        ];
        $response = $this->sendEmail($POST, $formData, $senderName);
    
        return redirect()->back()->with("response", $response);
    }

    private function sendEmail($POST, $formData, $senderName): array
    {
        $email = \Config\Services::email();

        $email->setFrom($POST["inquirer-email"], $POST["inquirer-name"]);
        $email->setTo("codeIgniter@gmail.com");

        $email->setSubject($POST["subject"]);

        $email->setMessage(view('mailDetail',  [
            'formData' => $formData,
            'senderName' => $senderName
        ]));

        if($email->send()){
            $response = [
                "title" => "Envio exitoso",
                "message" => "El email se envio correctamente",
                "type" => "success",
            ];
        }else{
            $response = [
                "title" => "Envio fallido",
                "mensaje" => "No se pudo realizar el envio del email",
                "type" => "error",
            ];
        }

        return $response;
    }
}
