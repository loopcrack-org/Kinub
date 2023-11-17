<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\HomeSectionModel;
use App\Validation\AboutUsValidation;
use Throwable;

class CtrlAboutUs extends BaseController
{
    public function viewAboutUsEdit()
    {
        $aboutUsData = (new HomeSectionModel())->first();

        return view('/admin/aboutUs/AboutUsEdit', ['aboutUsData' => $aboutUsData]);
    }

    public function updateAboutUsSection()
    {
        try {
            $aboutUsData = $this->request->getPost();
            $validator   = new AboutUsValidation();

            if (! $validator->validateInputs($aboutUsData)) {
                throw new InvalidInputException($validator->getErrors(), '');
            }

            $homeSectionModel            = new HomeSectionModel();
            $aboutUsData['aboutUsImage'] = '3ea307c224811d55048d72b5696895eb';
            $aboutUsData['aboutUsVideo'] = '3ea307c224811d55048d72b5696895eb';

            $homeSectionModel->updateData($aboutUsData);

            $response = [
                'title'   => 'Actualización exitosa',
                'message' => 'Los datos de la sección sobre nosotros han sido actualizados correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/nosotros')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->to('/admin/nosotros')->withInput()->with('errors', $th->getErros());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al actualizar los datos, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/nosotros')->with('response', $response)->withInput();
        }
    }
}
