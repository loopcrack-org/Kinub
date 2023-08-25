<?php

namespace App\Controllers;

use App\Validation\ContactEmailValidation;
use App\Validation\SupportEmailValidation;
use CodeIgniter\HTTP\RedirectResponse;

class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        $contactEmailValidation = new ContactEmailValidation();
        $POST = $this->request->getPost();

        if(!$contactEmailValidation->validateData($POST)){
            return redirect()->back()->withInput()->with("errors", $contactEmailValidation->getErrors());
        }

        return redirect()->back();
    }

    public function sendSupportEmail(): RedirectResponse
    {
        $supportEmailValidation = new SupportEmailValidation();
        $POST = $this->request->getPost();

        if(!$supportEmailValidation->validateData($POST)){
            return redirect()->back()->withInput()->with("errors", $supportEmailValidation->getErrors());
        }

        return redirect()->back();
    }
}
