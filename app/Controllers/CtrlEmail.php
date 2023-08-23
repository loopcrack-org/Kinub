<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class CtrlEmail extends BaseController
{
    public function sendContactEmail(): RedirectResponse
    {
        if($this->validate([
            "product-name" => "required",
            "inquirer-name" => "required|alpha_space",
            "inquirer-email" => "required|valid_emails",
            "message" => "required"
        ])){
            return redirect()->back();
        }else{
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }
    }
}
