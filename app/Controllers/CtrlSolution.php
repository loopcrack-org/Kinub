<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\MeasurementSolutionModel;
use App\Validation\SolutionValidation;
use Throwable;

class CtrlSolution extends BaseController
{
    public function viewSolutions()
    {
        $measurementSolutionModel = new MeasurementSolutionModel();
        $measurementSolutions     = $measurementSolutionModel->findAll();

        return view('admin/typeSolutions/Solutions', ['measurementSolutions' => $measurementSolutions]);
    }

    public function viewSolutionCreate()
    {
        return view('admin/typeSolutions/SolutionCreate');
    }

    public function viewSolutionEdit($id)
    {
        $measurementSolutionModel = new MeasurementSolutionModel();
        $measurementSolution      = $measurementSolutionModel->find($id);

        return view('admin/typeSolutions/SolutionEdit', ['solution' => $measurementSolution]);
    }

    public function createSolution()
    {
        try {
            $newMeasurementSolutionData       = $this->request->getPost();
            $measurementSolutionDataValidator = new SolutionValidation();

            if (! $measurementSolutionDataValidator->validateInputs($newMeasurementSolutionData)) {
                throw new InvalidInputException($measurementSolutionDataValidator->getErrors());
            }

            $newMeasurementSolutionData['msImageId'] = 1;
            $newMeasurementSolutionData['msIconId']  = 2;

            $measurementSolutionModel = new MeasurementSolutionModel();
            $measurementSolutionModel->insert($newMeasurementSolutionData);

            $response = [
                'title'   => 'Solución de medición registrada con éxito',
                'message' => 'La solución de medición se ha registrado exitosamente',
                'type'    => 'success',
            ];

            return redirect()->to('admin/soluciones')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->to('admin/soluciones/crear')->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al registrar los datos, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/soluciones/crear')->with('response', $response)->withInput();
        }
    }

    public function updateSolution($id)
    {
        $isUpdated = true;
        if ($isUpdated) {
            $response = [
                'title'   => 'Edición exitosa',
                'message' => 'Se ha actualizado la solución de medición correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Edición fallida',
                'message' => 'No se pudo realizar la edición de la solución de medición',
                'type'    => 'error',
            ];
        }

        return redirect()->to('/admin/soluciones')->with('response', $response);
    }

    public function deleteSolution()
    {
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado la solución de medición correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'No se pudo realizar la eliminación de la solución de medición',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
