<?php

namespace App\Controllers;

use App\Models\EmailModel;

class CtrlAdminEmail extends BaseController
{
    public function viewEmails()
    {
        $emailModel = new EmailModel();
        $emails     = $emailModel->findAll();

        return view('admin/emails/Emails', ['emails' => $emails]);
    }

    public function viewSpecificEmails($id)
    {
        $emailModel = new EmailModel();
        $email      = $emailModel->find($id);

        return view('admin/emails/SpecificEmails', ['email' => $email]);
    }

    public function deleteEmail()
    {
        return 'deleting email...';
    }
}
