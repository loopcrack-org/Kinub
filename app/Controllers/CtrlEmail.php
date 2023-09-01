<?php

namespace App\Controllers;

use App\Models\EmailModel;
use App\Utils\EmailSender;
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
            ],
            "customer" => [
                "label" => "Nombre del cliente",
                "output" => $POST["inquirer-name"]
            ]
        ];
        
        $successEmail =  EmailSender::sendEmail($POST["inquirer-name"],$POST['inquirer-email'],"kinub_admin@gmail.com", $subject, "mailDetail", $formData );

        if($successEmail){
            $response = [
                "title" => "Envío exitoso",
                "message" => "Se ha enviado correctamente",
                "type" => "success",
            ];
            $emailModel = new EmailModel();
            $data = [
                "idTypeEmail" => 1,
                "information" => json_encode($POST)
            ];
            $emailModel->insert($data);
        }else{
            $response = [
                "title" => "Envío fallido",
                "message" => "No se pudo realizar el envío del email",
                "type" => "error",
            ];
        }

        return redirect()->back()->with("response", $response);
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
            "customer" => [
                "label" => "Nombre del cliente",
                "output" => $POST["support-customer"]
            ]
        ];

        $successEmail =  EmailSender::sendEmail($POST["support-customer"],$POST['support-email'],"kinub_admin@gmail.com", $subject, "mailDetail", $formData );

        if($successEmail){
            $response = [
                "title" => "Envío exitoso",
                "message" => "Se ha enviado correctamente",
                "type" => "success",
            ];
            //Store form data in database
        }else{
            $response = [
                "title" => "Envío fallido",
                "message" => "No se pudo realizar el envío del email",
                "type" => "error",
            ];
        }

        return redirect()->back()->with("response", $response);
    }
    
    public function sendEmailToResetPassword() {
        return "sending email to reset password...";
    }
}
