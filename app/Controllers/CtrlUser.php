<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlUser extends BaseController
{
    public function viewUsers()
    {
        return view("admin/users/Users");
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
