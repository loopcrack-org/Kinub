<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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
        return "Sending access credentials..";
    }
    public function logout() {
        return "Closing session...";
    }
}
