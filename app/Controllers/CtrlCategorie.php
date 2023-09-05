<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlCategorie extends BaseController
{
    public function viewCategories()
    {
        return view("admin/Categories");
    }
    public function viewCategorieCreate() {
        return view("admin/CategorieCreate");
    }
    public function viewCategorieEdit($id) {
        return view("admin/CategorieEdit", ["id"=>$id]);
    }
    public function createCategorie() {
        return "creating categorie...";
    }
    public function updateCategorie($id) {
        return "updating categorie... $id";
    }
    public function deleteCategorie() {
        return "deleting categorie...";
    }
}
