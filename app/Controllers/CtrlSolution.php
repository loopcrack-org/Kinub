<?php

namespace App\Controllers;

class CtrlSolution extends BaseController
{
    public function viewSolutions()
    {
        return view('admin/typeSolutions/Solutions');
    }

    public function viewSolutionCreate()
    {
        return view('admin/typeSolutions/SolutionCreate');
    }

    public function viewSolutionEdit($id)
    {
        return view('admin/typeSolutions/SolutionEdit', ['id' => $id]);
    }

    public function createSolution()
    {
        return 'creating solution...';
    }

    public function updateSolution($id)
    {
        return "updating solution... {$id}";
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
