<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Seeds\EmailSeeder;
use App\Models\UserModel;
use App\Utils\EmailSender;

class CtrlUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return view("admin/users/Users", ["users" => $users]);
    }
    public function viewUserCreate()
    {
        return view("admin/users/UserCreate");
    }
    public function createUser()
    {
        $POST = $this->request->getPost();

        return view("templates/emails/createUserAccount", [
            "user" => $POST,
            "userToken" => "FAS12AQajqa"
        ]);
    }
    public function deleteUser()
    {
        return "deleting user...";
    }
}
