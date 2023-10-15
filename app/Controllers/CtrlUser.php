<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class CtrlUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return view("admin/users/Users", ["users" => $users]);
    }
    public function viewUserCreate() {
        return view("admin/users/UserCreate");
    }
    public function createUser() {
        return "creating user...";
    }
    public function deleteUser() {
        return "deleting user...";
    }
}
