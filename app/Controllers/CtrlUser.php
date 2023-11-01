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
        $users     = $userModel->findAll();

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
        return "updating user... {$id}";
    }

    public function updateUser($id)
    {
        $isEdited = true;
        if ($isEdited) {
            $response = [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha editado el usuario correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Error en la edición',
                'message' => 'Ha ocurrido un error al editar el usuario. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];
        }

        return redirect()->to('admin/usuarios')->with('response', $response);
    }

    public function deleteUser()
    {
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el usuario correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'No se pudo realizar la eliminación del usuario',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
