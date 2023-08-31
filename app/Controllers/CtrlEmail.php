<?php

namespace App\Controllers;

use App\Models\EmailModel;
use App\Utils\SendEmail;
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
        
        $successEmail = SendEmail::sendEmailMailer($POST["inquirer-name"],$POST['inquirer-email'],"kinub_admin@gmail.com", $subject, "mailDetail", $formData );

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

        return redirect()->back();
    }
    
    public function sendEmailToResetPassword() {
        return "sending email to reset password...";
    }
}
