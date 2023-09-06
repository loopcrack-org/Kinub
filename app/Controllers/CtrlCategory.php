<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlCategory extends BaseController
{
    public function viewCategories()
    {
        return view("admin/categories/Categories");
    }
    public function viewCategoryCreate() {
        return view("admin/categories/CategoryCreate");
    }
    public function viewCategoryEdit($id) {
        return view("admin/categories/CategoryEdit", ["id"=>$id]);
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
