<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlCategory extends BaseController
{
    public function viewCategories()
    {
        return view("admin/Categories");
    }
    public function viewCategoryCreate() {
        return view("admin/CategoryCreate");
    }
    public function viewCategoryEdit($id) {
        return view("admin/CategoryEdit", ["id"=>$id]);
    }
    public function createCategory() {
        return "creating Category...";
    }
    public function updateCategory($id) {
        return "updating Category... $id";
    }
    public function deleteCategory() {
        return "deleting Category...";
    }
}
