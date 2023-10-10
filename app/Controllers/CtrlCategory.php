<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CategoryTagModel;

class CtrlCategory extends BaseController
{
    public function viewCategories()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        return view("admin/categories/Categories", ["categories" => $categories]);
    }
    public function viewCategoryCreate() {
        return view("admin/categories/CategoryCreate");
    }
    public function viewCategoryEdit($id) {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        $tagModel = new CategoryTagModel();
        $tags = $tagModel->where('categoryId', $id)->findAll();
        foreach ($tags as $tag){
            $tagNames[] = $tag['categoryTagName'];
        }
        $category["tags"] = implode(',', $tagNames);

        return view("admin/categories/CategoryEdit", ["category"=>$category]);
    }
    public function createCategory() {
        return "creating Category...";
    }
    public function updateCategory($id) {
        return "updating Category... $id";
    }
    public function deleteCategory() {
        $isDeleted = true;
        if($isDeleted){
            $response = [
                "title" => "Eliminación exitosa",
                "message" => "Se ha elimnado la categoría correctamente",
                "type" => "success",
            ];
        }else{
            $response = [
                "title" => "Eliminación fallida",
                "message" => "No se pudo realizar la eliminación de la categoría",
                "type" => "error",
            ];
        }
        
        return redirect()->back()->with("response", $response);
    }
}