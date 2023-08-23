<?php

namespace App\Controllers;

class CtrlPublicPages extends BaseController
{
    public function index(): string
    {
        return view('auth/index');
    }
}
