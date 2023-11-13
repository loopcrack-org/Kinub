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

    public function deleteEmail()
    {
        return 'deleting email...';
    }
}
