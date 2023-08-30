<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Validation\LoginValidation;

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

        if($loginValidation->validateInputs($data)) {
            if($user = $loginValidation->validateCredentials($email, $password)) {
                session()->set("user", $user);
                session()->set("is_logged", true);
                return "administration panel";
            }
        }

        return redirect()->back()->with("errors", $loginValidation->getErrors());
    }
    public function logout() {
        return "Closing session...";
    }
}
