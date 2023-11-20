<?php

namespace App\Controllers;

use App\Models\MeasurementSolutionModel;
use App\Validation\SolutionValidation;
use Exception;
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
        $validateMeasurementSolution = new SolutionValidation();
        $measurementSolutionData     = $this->request->getPost(['msName', 'msDescription']);

        try {
            if (! $validateMeasurementSolution->validateInputs($measurementSolutionData)) {
                throw new Exception();
            }

            $measurementSolutionModel             = new MeasurementSolutionModel();
            $measurementSolutionData['msImageId'] = 1;
            $measurementSolutionData['msIconId']  = 2;

            $isCreated = $measurementSolutionModel->insert($measurementSolutionData);

            if (! $isCreated) {
                throw new Exception('Algo salio mal al registrar la solución de medición. Por favor, inténtalo de nuevo.');
            }

            $response = [
                'title'   => 'Solución de medición registrada con éxito',
                'message' => 'La solución de medición se ha registrado exitosamente',
                'type'    => 'success',
            ];
        } catch (Throwable $th) {
            dd($th);
            $errors = $validateMeasurementSolution->getErrors();

            if (empty($errors)) {
                $response = [
                    'title'   => '¡Oops!',
                    'message' => $th->getMessage(),
                    'type'    => 'error',
                ];
            } else {
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        }

        return redirect()->to('/admin/soluciones')->with('response', $response);
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
