<?php

namespace App\Controllers;

use App\Exceptions\EmailNotSendException;
use App\Models\UserModel;
use App\Models\UserTokenModel;
use App\Utils\EmailSender;
use App\Validation\UserValidation;
use Exception;
use Throwable;

class CtrlUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = new UserModel();
        $users     = $userModel->where('isAdmin', '0')->findAll();

        return view('admin/users/Users', ['users' => $users]);
    }

    public function viewUserCreate()
    {
        return view('admin/users/UserCreate');
    }

    public function viewUserEdit(string $userId)
    {
        $userModel = new UserModel();
        $user      = $userModel->find($userId);

        return view('admin/users/UserEdit', ['user' => $user]);
    }

    public function createUser()
    {
        $validateUser = new UserValidation();
        $userData     = $this->request->getPost();

        try {
            if (! $validateUser->validateInputs($userData)) {
                throw new Exception();
            }

            $userModel = new UserModel();
            $user      = $userModel->where('userEmail', $userData['userEmail'])->first();
            $validateUser->existUserEmail($user);
            $userData['confirmed'] = 0;
            $userData['isAdmin']   = 0;

            $userId = $userModel->insert($userData);

            $userData['userToken'] = (new UserTokenModel())->getNewUserToken($userId);

            $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $userData['userEmail'], 'Cuenta Creada de Kinub', 'templates/emails/createUserAccount', $userData);

            if (! $isSend) {
                $userModel->where('userEmail', $userData['userEmail'])->delete();

                throw new Exception('Algo salio mal al crear el usuario. Por favor, inténtalo de nuevo.');
            }

            $response = [
                'title'   => 'Usuario creado con éxito',
                'message' => 'La cuenta se ha creado con éxito. Por favor notifique al usuario para que revise su bandeja de entrada y confirme su cuenta.',
                'type'    => 'success',
            ];
        } catch (Throwable $th) {
            $errors = $validateUser->getErrors();

            if (empty($errors)) {
                $response = [
                    'title'   => '¡Oops!',
                    'message' => $th->getMessage(),
                    'type'    => 'error',
                ];
            } else {
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        }

        return redirect()->to('/admin/usuarios')->with('response', $response);
    }

    public function updateUser(string $userId)
    {
        $validateUser = new UserValidation();
        $POST         = $this->request->getPost();

        try {
            if (! $validateUser->validateInputs($POST)) {
                throw new Exception();
            }

            $userModel = new UserModel();
            $user      = $userModel->find($userId);
            if ($user['userEmail'] === $POST['userEmail']) {
                $response = [
                    'title'   => 'Edición exitosa',
                    'message' => 'Se ha editado el usuario correctamente',
                    'type'    => 'success',
                ];
            } else {
                $user = $userModel->where('userEmail', $POST['userEmail'])->first();
                $validateUser->existUserEmail($user);

                $newUserToken = (new UserTokenModel())->getNewUserToken($userId);

                $POST['confirmed']    = 0;
                $POST['userPassword'] = null;
                $emailInfo            = array_merge($POST, ['userToken' => $newUserToken]);

                $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $POST['userEmail'], 'Cuenta Creada de Kinub', 'templates/emails/createUserAccount', $emailInfo);

                if (! $isSend) {
                    throw new Exception('Algo salio mal al editar el usuario. Por favor, inténtalo de nuevo.');
                }

                $response = [
                    'title'   => 'Edición exitosa',
                    'message' => 'La cuenta se ha actualizado con éxito. Por favor, notifique al usuario para que verifique su bandeja de entrada y confirme su cuenta.',
                    'type'    => 'success',
                ];
            }
            $userModel->update($userId, $POST);
        } catch (Throwable $th) {
            $errors = $validateUser->getErrors();

            if (empty($errors)) {
                $response = [
                    'title'   => '¡Oops!',
                    'message' => $th->getMessage(),
                    'type'    => 'error',
                ];
            } else {
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        }

        return redirect()->to('admin/usuarios')->with('response', $response);
    }

    public function resendConfirmationEmail(string $userId)
    {
        try {
            $userData = (new UserModel())->getUserDataToResendConfirmEmail($userId);

            $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $userData['userEmail'], 'Cuenta Creada de Kinub', 'templates/emails/createUserAccount', $userData);

            if (! $isSend) {
                throw new EmailNotSendException('Ha ocurrido un error al enviar el email para la confirmación de la cuenta, por favor intente nuevamente.');
            }

            $response = [
                'title'   => 'Envio Exitoso',
                'message' => 'El email ha sido enviado correctamente, notifique al usuario para que confirme su cuenta.',
                'type'    => 'success',
            ];

            return redirect()->back()->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error',
                'message' => 'Algo ha salido mal mientras se enviaba el email, por favor intente nuevamente',
                'type'    => 'error',
            ];

            return redirect()->back()->with('response', $response);
        }
    }

    public function deleteUser()
    {
        $POST      = $this->request->getPost();
        $userId    = $POST['userId'];
        $userModel = new UserModel();
        $user      = $userModel->find($userId);
        $isDeleted = false;
        if (! empty($user)) {
            if ($user['isAdmin'] !== '1') {
                $isDeleted = $userModel->delete($userId);
            }
        }

        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el usuario correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'Algo salio mal al eliminar el usuario. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
