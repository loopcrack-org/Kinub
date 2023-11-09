<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\EmailSender;
use App\Utils\TokenGenerator;
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

    public function viewUserEdit($id)
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        return view('admin/users/UserEdit', ['user' => $user]);
    }

    public function createUser()
    {
        $validateUser = new UserValidation();
        $POST         = $this->request->getPost();

        try {
            if (! $validateUser->validateInputs($POST)) {
                throw new Exception();
            }

            $userModel = new UserModel();
            $user      = $userModel->where('userEmail', $POST['userEmail'])->first();
            $validateUser->existUserEmail($user);

            $token             = TokenGenerator::generateToken();
            $POST['userToken'] = $token;
            $POST['confirmed'] = 0;
            $POST['isAdmin']   = 0;
            $userModel->insert($POST);

            $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $POST['userEmail'], 'Cuenta Creada de Kinub', 'templates/emails/createUserAccount', $POST);

            if (! $isSend) {
                $userModel->where('userEmail', $POST['userEmail'])->delete();

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

    public function updateUser($id)
    {
        $validateUser = new UserValidation();
        $POST         = $this->request->getPost();

        try {
            if (! $validateUser->validateInputs($POST)) {
                throw new Exception();
            }

            $userModel = new UserModel();
            $user      = $userModel->find($id);
            if ($user['userEmail'] === $POST['userEmail']) {
                $response = [
                    'title'   => 'Edición exitosa',
                    'message' => 'Se ha editado el usuario correctamente',
                    'type'    => 'success',
                ];
            } else {
                $user = $userModel->where('userEmail', $POST['userEmail'])->first();
                $validateUser->existUserEmail($user);
                $token = TokenGenerator::generateToken();

                $POST['userToken']    = $token;
                $POST['confirmed']    = 0;
                $POST['userPassword'] = null;

                $isSend = EmailSender::sendEmail('Kinub', 'kinub@gmail.com', $POST['userEmail'], 'Cuenta Creada de Kinub', 'templates/emails/createUserAccount', $POST);

                if (! $isSend) {
                    throw new Exception('Algo salio mal al editar el usuario. Por favor, inténtalo de nuevo.');
                }

                $response = [
                    'title'   => 'Edición exitosa',
                    'message' => 'La cuenta se ha actualizado con éxito. Por favor, notifique al usuario para que verifique su bandeja de entrada y confirme su cuenta.',
                    'type'    => 'success',
                ];
            }
            $userModel->update($id, $POST);
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
