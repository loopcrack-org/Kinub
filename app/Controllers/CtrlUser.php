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
        return 'deleting user...';
    }
}
