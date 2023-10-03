<?php

namespace App\Controllers;

use App\Models\EmailModel;
use App\Utils\EmailSender; 
use App\Models\UserModel;
use App\Validation\ContactEmailValidation;
use App\Validation\PasswordEmailValidation;
use App\Validation\SupportEmailValidation;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;
class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        $contactEmailValidation = new ContactEmailValidation();
        $POST = $this->request->getPost();

        if (!$contactEmailValidation->validateData($POST)) {
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

        $successEmail =  EmailSender::sendEmail($POST["inquirer-name"], $POST['inquirer-email'], "kinub_admin@gmail.com", $subject, "mailDetail", $formData);

        if ($successEmail) {
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
        } else {
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
        if (!$supportEmailValidation->validateData($POST)) {
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

        $successEmail = EmailSender::sendEmail($POST["support-customer"],$POST['support-email'],"kinub_admin@gmail.com", $subject, "mailDetail", $formData );

        if($successEmail){
            $response = [
                "title" => "Envío exitoso",
                "message" => "Se ha enviado correctamente",
                "type" => "success",
            ];
            $emailModel = new EmailModel();
            $data = [
                "idTypeEmail" => 2,
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

    public function sendEmailToResetPassword()
    {
        $validateEmail = new PasswordEmailValidation();
        $data = $this->request->getPost();

        try {
            if (!$validateEmail->validateInputs($data)) throw new Exception();

            $userModel = new UserModel();
            $user = $userModel->where("email", $data['email'])->first();

            $validateEmail->existUserWithEmail($user);
            $validateEmail->isNotSuperAdmin($user['admin']);

            $token = uniqid();
            $userName =  $user['name'] . " " . $user['lastName'];

            $isSend = EmailSender::sendEmail("Kinub", 'kinub@gmail.com', $data['email'], 'Restablecer Contraseña', 'templates/emails/passwordReset',  ['userName' =>  $userName, 'token' => $token] );

            if (!$isSend) throw new Exception('Algo ha salido mal, por favor recargue la página e intente nuevamente');

            $response = [
                'title' => "Restablezca su contraseña",
                'message' => 'Verifique su bandeja de entrada para poder restablecer su contraseña.',
                'type' => 'success',
            ];

            $userModel->update($user['id'], ['token' => $token]);
        } catch (\Throwable $th) {
            $errors = $validateEmail->getErrors();

            if (!isset($errors['email'])) {
                $response = [
                    'title' => "Oops",
                    'message' => $th->getMessage(),
                    'type' => 'danger',
                ];
            } else {
                return redirect()->back()->with("errors", $errors);
            }
        }

        return redirect()->back()->with("response", $response);
    }
}
