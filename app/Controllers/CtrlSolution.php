<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
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

    public function updateSolution(string $msId)
    {
        try {
            $msData          = $this->request->getPost();
            $msData['msId']  = $msId;
            $msDataValidator = new SolutionValidation();

            if (! $msDataValidator->validateInputs($msData)) {
                throw new InvalidInputException($msDataValidator->getErrors());
            }

            $msModel = new MeasurementSolutionModel();
            $msModel->updateMeasurementSolution($msData);

            $response = [
                'title'   => 'Actualización exitosa',
                'message' => 'Los datos de la solución de medición han sido actualizados correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/soluciones')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->back()->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => $th->getMessage(),
                'type'    => 'error',
            ];
        }

        return redirect()->to('/admin/soluciones')->with('response', $response);
    }

    public function deleteSolution()
    {
        try {
            $msId                     = $this->request->getPost()['msId'];
            $measurementSolutionModel = new MeasurementSolutionModel();

            $isDeleted = $measurementSolutionModel->delete($msId);

            if (! $isDeleted) {
                throw new Exception();
            }

            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado la solución de medición correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/soluciones')->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al tratar de eliminar la solución de medición, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/soluciones')->with('response', $response);
        }
    }
}
