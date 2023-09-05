<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlSolution extends BaseController
{
    public function viewSolutions()
    {
        return view("admin/Solutions");
    }
    public function viewSolutionCreate() {
        return view("admin/SolutionCreate");
    }
    public function viewSolutionEdit($id) {
        return view("admin/SolutionEdit", ["id"=>$id]);
    }
    public function createSolution() {
        return "creating solution...";
    }
    public function updateSolution($id) {
        return "updating solution... $id";
    }
    public function deleteSolution() {
        return "deleting solution...";
    }
}
