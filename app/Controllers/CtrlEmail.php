<?php

namespace App\Controllers;

use App\Models\EmailModel;
use App\Validation\ContactEmailValidation;
use App\Validation\SupportEmailValidation;
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

        $subject = "Mensaje del formulario de contacto";
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
        
        $response = $this->sendEmail($subject, $POST['inquirer-email'], $senderName, $formData);

        if($response['type'] === "success"){
            $emailModel = new EmailModel();
            $data = [
                "idTypeEmail" => 1,
                "information" => json_encode($POST)
            ];
            $emailModel->insert($data);
        }
        return redirect()->back()->with("response", $response);
    }

    private function sendEmail($subject, $senderEmail, $senderName, $formData): array
    {
        $email = \Config\Services::email();

        $email->setFrom($senderEmail, $senderName['output']);
        $email->setTo("codeIgniter@gmail.com");

        $email->setSubject($subject);

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
                "message" => "No se pudo realizar el envio del email",
                "type" => "error",
            ];
        }

        return $response;
    }

    public function sendSupportEmail(): RedirectResponse
    {
        $supportEmailValidation = new SupportEmailValidation();
        $POST = $this->request->getPost();

        if(!$supportEmailValidation->validateData($POST)){
            return redirect()->back()->withInput()->with("errors", $supportEmailValidation->getErrors());
        }

        $subject = "Mensaje del formulario de soporte técnico";
        $formData = [
            "support-phone" => [
                "label" => "Teléfono",
                "output" => $POST["support-phone"]
            ],
            "support-model" => [
                "label" => "Modelo del producto",
                "output" => $POST["support-model"]
            ],
            "support-serial" => [
                "label" => "Número de serie del producto",
                "output" => $POST["support-serial"]
            ],
            "support-problem-type" => [
                "label" => "Tipo de problema",
                "output" => $POST["support-problem-type"]
            ],
            "support-problem" => [
                "label" => "Problema",
                "output" => $POST["support-problem"]
            ],
        ];
        $senderName = [
            "label" => "Nombre del cliente",
            "output" => $POST["support-customer"]
        ];

        $response = $this->sendEmail($subject, $POST["support-email"], $senderName, $formData);

        return redirect()->back()->with("response", $response);
    }
    
    public function sendEmailToResetPassword() {
        return "sending email to reset password...";
    }
}
