<?php

namespace App\Controllers;

use App\Models\UserModel;

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

    public function createUser()
    {
        $POST              = $this->request->getPost();
        $POST['userToken'] = 'FAS12AQajqa';

        return view('templates/emails/createUserAccount', [
            'formData' => $POST,
        ]);
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
