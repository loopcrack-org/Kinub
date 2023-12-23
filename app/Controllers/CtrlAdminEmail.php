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
        $emailId    = $this->request->getPost('emailId');
        $emailModel = new EmailModel();
        $email      = $emailModel->find($emailId);

        $isDeleted = false;
        if (! empty($email)) {
            $isDeleted = $emailModel->delete($emailId);
        }

        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha eliminado el email correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'Algo salio mal al eliminar el email. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
