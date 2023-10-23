<?php

namespace App\Controllers;

use App\Models\UserModel;

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
        $POST              = $this->request->getPost();
        $POST['userToken'] = 'FAS12AQajqa';

        return view('templates/emails/createUserAccount', [
            'formData' => $POST,
        ]);
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
