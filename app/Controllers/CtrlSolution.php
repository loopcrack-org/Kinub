<?php

namespace App\Controllers;

use App\Models\MeasurementSolutionModel;

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
        return 'creating solution...';
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
        $POST                     = $this->request->getPost();
        $msId                     = $POST['msId'];
        $measurementSolutionModel = new MeasurementSolutionModel();
        $measurementSolution      = $measurementSolutionModel->find($msId);

        $isDeleted = false;
        if (! empty($measurementSolution)) {
            $isDeleted = $measurementSolutionModel->delete($msId);
        }

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
