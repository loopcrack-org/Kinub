<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Validation\ChangePasswordValidation;
use App\Validation\LoginValidation;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\Exceptions\DataException;
use Exception;

class CtrlLogin extends BaseController
{
    public function index(): string {
        return view("login/index");
    }
    public function viewPasswordEmail(): string {
        return view("login/PasswordEmail");
    }
    public function viewPasswordReset($token): string {
        return view("login/PasswordReset", [
            "token" => $token
        ]);
    }
    public function passwordReset($token) {
        $changePasswordValidation = new ChangePasswordValidation();
        
        $data = $this->request->getPost();

        try {
            if(!$changePasswordValidation->validateInputs($data)) throw new Exception();
            $userModel = new UserModel();
            $user = $userModel->where("token", $token)->first();
            
            $changePasswordValidation->existUserWithToken($user);

            $result = $userModel->update($user["id"], [
                "token" => null,
                "password" =>$data["password"]
            ]);
            if($result) {
                $response = [
                    "type" => "success",
                    "title" => "Contraseña actualizada correctamente",
                    "message" => "Porfavor, inicia sesión para comenzar",
                ];
            }
        } catch (Exception $e) {
            $errors = $changePasswordValidation->getErrors();
            if(isset($errors["connection"])) {
                $response = [
                    "type" => "danger",
                    "title" => "¡Oops!",
                    "message" => $errors["connection"],
                ];
            } else {
                return redirect()->back()->with("errors", $errors);
            }
        }
        return redirect()->to("login/password/reset")->with("response", $response);

    }
    public function login() {
        $loginValidation = new LoginValidation();

        $data = $this->request->getPost();

        $email = trim($data["email"]);
        $password = trim($data["password"]);

        try {
            if(!$loginValidation->validateInputs($data)) throw new Exception();
            $user = (new UserModel())->where("email", $email)->first();
            $loginValidation->validateCredentials($user, $password);
            session()->set("user", [
                "name" => $user["name"] . " " . $user["lastName"],
                "email" => $user["email"],
                "admin" => $user["admin"],
            ]);
            session()->set("is_logged", true);
        } catch (\Throwable $th) {
            return redirect()->back()->with("errors", $loginValidation->getErrors());
        }

        return "administration panel";
    }
    public function logout() {
        return "Closing session...";
    }
}
