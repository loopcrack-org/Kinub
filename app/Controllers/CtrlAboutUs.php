<?php

namespace App\Controllers;

class CtrlAboutUs extends BaseController
{
    public function viewAboutUsEdit()
    {
        return view('/admin/aboutUs/AboutUsEdit');
    }

    public function updateAboutUsSection()
    {
        $response = [
            'title'   => 'Actualización exitosa',
            'message' => 'Los datos de la sección sobre nosotros han sido actualizados correctamente',
            'type'    => 'success',
        ];

        return redirect()->to('/admin/nosotros')->with('response', $response);
    }
}
