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
    public function viewUserCreate()
    {
        return view("admin/users/UserCreate");
    }
    public function createUser()
    {
        return "creating user...";
    }
    public function deleteUser()
    {
        $isDeleted = true;
        if($isDeleted) {
            $response = [
                "title" => "Eliminación exitosa",
                "message" => "Se ha elimnado el usuario correctamente",
                "type" => "success",
            ];
        } else {
            $response = [
                "title" => "Eliminación fallida",
                "message" => "No se pudo realizar la eliminación del usuario",
                "type" => "error",
            ];
        }

        return redirect()->back()->with("response", $response);
    }
}
