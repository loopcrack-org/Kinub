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
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el email correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'No se pudo realizar la eliminación del email',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
