<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Validation\LoginValidation;
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
        return "Changing Password with token: $token...";
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
