<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\TagModel;

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

        $tagModel = new TagModel();
        $tags = $tagModel->where('idCategory', $id)->findAll();
        foreach ($tags as $tag){
            $tagNames[] = $tag['name'];
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
        return "deleting Category...";
    }
}