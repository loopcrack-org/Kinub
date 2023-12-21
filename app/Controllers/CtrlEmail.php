<?php

namespace App\Controllers;

use App\Exceptions\EmailNotSendException;
use App\Exceptions\InvalidInputException;
use App\Models\EmailModel;
use App\Models\UserModel;
use App\Models\UserTokenModel;
use App\Utils\EmailSender;
use App\Validation\ContactEmailValidation;
use App\Validation\PasswordEmailValidation;
use App\Validation\ProductEmailValidation;
use App\Validation\SupportEmailValidation;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;
use Throwable;

class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        $contactEmailValidation = new ContactEmailValidation();
        $POST                   = $this->request->getPost();

        if (! $contactEmailValidation->validateData($POST)) {
            return redirect()->back()->withInput()->with('errors', $contactEmailValidation->getErrors());
        }

        $subject  = 'Mensaje del formulario de contacto';
        $formData = [
            'product-name' => [
                'label'  => 'Producto',
                'output' => $POST['product-name'],
            ],
            'message' => [
                'label'  => 'Mensaje',
                'output' => $POST['message'],
            ],
            'customer' => [
                'label'  => 'Nombre del cliente',
                'output' => $POST['inquirer-name'],
            ],
        ];

        $successEmail = EmailSender::sendEmail($POST['inquirer-name'], $POST['inquirer-email'], 'kinub_admin@gmail.com', $subject, 'mailDetail', $formData);

        if ($successEmail) {
            $response = [
                'title'   => 'Envío exitoso',
                'message' => 'Se ha enviado correctamente',
                'type'    => 'success',
            ];
            $emailModel = new EmailModel();
            $data       = [
                'emailTypeId'   => CONTACT_EMAIL_ID,
                'inquirerName'  => $POST['inquirer-name'],
                'inquirerEmail' => $POST['inquirer-email'],
                'emailContent'  => EmailSender::getEmailBody($formData, 'mailDetail'),
            ];
            $emailModel->insert($data);
        } else {
            $response = [
                'title'   => 'Envío fallido',
                'message' => 'No se pudo realizar el envío del email',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }

    public function sendProductEmail(): RedirectResponse
    {
        try {
            $productEmailValidation = new ProductEmailValidation();
            $productEmailData       = $this->request->getPost();

            if (! $productEmailValidation->validateInputs($productEmailData)) {
                throw new InvalidInputException($productEmailValidation->getErrors());
            }

            $subject  = 'Mensaje del formulario de producto';
            $formData = [
                'product-name' => [
                    'label'  => 'Producto',
                    'output' => $productEmailData['product-name'],
                ],
                'product-model' => [
                    'label'  => 'Modelo',
                    'output' => $productEmailData['product-model'],
                ],
                'customer' => [
                    'label'  => 'Nombre del cliente',
                    'output' => $productEmailData['inquirer-name'],
                ],
                'inquirer-phone' => [
                    'label'  => 'Teléfono',
                    'output' => $productEmailData['inquirer-phone'],
                ],
                'inquirer-email' => [
                    'label'  => 'Email',
                    'output' => $productEmailData['inquirer-email'],
                ],
                'message' => [
                    'label'  => 'Mensaje',
                    'output' => $productEmailData['message'],
                ],
            ];

            $successEmail = EmailSender::sendEmail($productEmailData['inquirer-name'], $productEmailData['inquirer-email'], 'kinub_admin@gmail.com', $subject, 'mailDetail', $formData);

            if (! $successEmail) {
                throw new EmailNotSendException('Ha ocurrido un error al enviar email');
            }

            $data = [
                'emailTypeId'   => PRODUCT_EMAIL_ID,
                'inquirerName'  => $productEmailData['inquirer-name'],
                'inquirerEmail' => $productEmailData['inquirer-email'],
                'emailContent'  => EmailSender::getEmailBody($formData, 'mailDetail'),
            ];
            (new EmailModel())->insert($data);

            $response = [
                'title'   => 'Mensaje enviado correctamente',
                'message' => 'El Formulario se ha enviado a nuestro equipo, trataremos de ponernos en contacto con usted lo más pronto posible para brindarle más información del producto.',
                'type'    => 'success',
            ];

            return redirect('producto')->with('response', $response);
        } catch (InvalidInputException $th) {
            $response = [
                'title'   => 'Oops! No se ha realizado el envio del email',
                'message' => 'Por favor corrobore que todos los datos hayan sido proporcionados para poder realizar el envio del email',
                'type'    => 'error',
            ];

            return redirect('producto')->withInput()->with('errors', $th->getErrors())->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error mientras se enviaba el email. Por favor intente nuevamente',
                'type'    => 'error',
            ];

            return redirect('producto')->withInput()->with('response', $response);
        }
    }

    public function sendSupportEmail(): RedirectResponse
    {
        $supportEmailValidation = new SupportEmailValidation();
        $POST                   = $this->request->getPost();
        if (! $supportEmailValidation->validateData($POST)) {
            return redirect()->back()->withInput()->with('errors', $supportEmailValidation->getErrors());
        }
        $subject  = 'Mensaje del formulario de soporte técnico';
        $formData = [
            'support-phone' => [
                'label'  => 'Teléfono',
                'output' => $POST['support-phone'],
            ],
            'support-model' => [
                'label'  => 'Modelo del producto',
                'output' => $POST['support-model'],
            ],
            'support-serial' => [
                'label'  => 'Número de serie del producto',
                'output' => $POST['support-serial'],
            ],
            'support-problem-type' => [
                'label'  => 'Tipo de problema',
                'output' => $POST['support-problem-type'],
            ],
            'support-problem' => [
                'label'  => 'Problema',
                'output' => $POST['support-problem'],
            ],
            'customer' => [
                'label'  => 'Nombre del cliente',
                'output' => $POST['support-customer'],
            ],
        ];

        $successEmail = EmailSender::sendEmail($POST['support-customer'], $POST['support-email'], 'kinub_admin@gmail.com', $subject, 'mailDetail', $formData);

        if ($successEmail) {
            $response = [
                'title'   => 'Mensaje enviado correctamente',
                'message' => 'El Formulario se ha enviado a nuestro equipo de soporte técnico, trataremos de ponernos en contacto con usted lo más pronto posible.',
                'type'    => 'success',
            ];
            $emailModel = new EmailModel();
            $data       = [
                'emailTypeId'   => SUPPORT_EMAIL_ID,
                'inquirerName'  => $POST['support-customer'],
                'inquirerEmail' => $POST['support-email'],
                'emailContent'  => EmailSender::getEmailBody($formData, 'mailDetail'),
            ];
            $emailModel->insert($data);
        } else {
            $response = [
                'title'   => 'Envío fallido',
                'message' => 'No se pudo realizar el envío del formulario',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }

    public function sendEmailToResetPassword()
    {
        $validateEmail = new PasswordEmailValidation();
        $data          = $this->request->getPost();

        try {
            if (! $validateEmail->validateInputs($data)) {
                throw new InvalidInputException($validateEmail->getErrors());
            }

            $userModel = new UserModel();
            $user      = $userModel->where('userEmail', $data['email'])->first();
            $validateEmail->existUserWithEmail($user);
            $validateEmail->validateConfirmedAccount($user['confirmed']);
            $validateEmail->isNotSuperAdmin($user['isAdmin']);

            $userName = $user['userFirstName'] . ' ' . $user['userLastName'];

            $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $data['email'], 'Restablecer Contraseña', 'templates/emails/passwordReset', ['userName' => $userName, 'token' => (new UserTokenModel())->getNewUserToken($user['userId'])]);

            if (! $isSend) {
                throw new Exception('Algo ha salido mal, por favor recargue la página e intente nuevamente');
            }

            $response = [
                'title'   => 'Restablezca su contraseña',
                'message' => 'Verifique su bandeja de entrada para poder restablecer su contraseña.',
                'type'    => 'success',
            ];
        } catch (InvalidInputException $th) {
            return redirect()->back()->with('errors', $validateEmail->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops',
                'message' => $th->getMessage(),
                'type'    => 'danger',
            ];
        }

        return redirect()->to('/password_response')->with('response', $response);
    }
}
