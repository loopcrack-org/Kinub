<?php

namespace App\Controllers;

class CtrlPublicPages extends BaseController
{
    public function index(): string
    {
        return view('public/index');
    }

    public function viewSupport(): string
    {
        return view('public/support');
    }

    public function viewEquipment(): string
    {
        return view('public/equipment');
    }

    public function viewCertificates(): string
    {
        return view('public/certificates');
    }
}
