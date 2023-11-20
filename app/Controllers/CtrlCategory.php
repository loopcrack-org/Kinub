<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\CategoryModel;
use App\Models\CategoryTagModel;
use App\Validation\CategoryValidation;
use Throwable;

class CtrlCategory extends BaseController
{
    public function viewCategories()
    {
        $categoryModel = new CategoryModel();
        $categories    = $categoryModel->findAll();

        return view('admin/categories/Categories', ['categories' => $categories]);
    }

    public function viewCategoryCreate()
    {
        return view('admin/categories/CategoryCreate');
    }

    public function viewCategoryEdit($id)
    {
        $categoryModel = new CategoryModel();
        $category      = $categoryModel->find($id);

        $tagModel = new CategoryTagModel();
        $tags     = $tagModel->where('categoryId', $id)->findAll();

        foreach ($tags as $tag) {
            $tagNames[] = $tag['categoryTagName'];
        }
        $category['categoryTags'] = implode(',', $tagNames);

        return view('admin/categories/CategoryEdit', ['category' => $category]);
    }

    public function createCategory()
    {
        try {
            $categoryData = $this->request->getPost();

            $validator = new CategoryValidation();

            if (! $validator->validateInputs($categoryData)) {
                throw new InvalidInputException($validator->getErrors());
            }

            $categoryData['icon']  = '3ea307c224811d55048d72b5696895eb';
            $categoryData['image'] = '3ea307c224811d55048d72b5696895eb';

            (new CategoryModel())->createCategory($categoryData);

            $response = [
                'title'   => 'Nueva categoría creada',
                'message' => 'La categoría ha sido creada correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/categorias')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->to('/admin/categorias/crear')->withInput()->with('errors', $th->getErros());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al guardar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/categorias/crear')->withInput()->with('response', $response);
        }
    }

    public function updateCategory($id)
    {
        return "updating Category... {$id}";
    }

    public function deleteCategory()
    {
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado la categoría correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'No se pudo realizar la eliminación de la categoría',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
