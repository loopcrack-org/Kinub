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
            return redirect()->to('/admin/categorias/crear')->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al guardar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to('/admin/categorias/crear')->withInput()->with('response', $response);
        }
    }

    public function updateCategory(string $categoryId)
    {
        try {
            $categoryData = $this->request->getPost();

            $validator = new CategoryValidation();

            if (! $validator->validateInputs($categoryData)) {
                throw new InvalidInputException($validator->getErrors());
            }

            $categoryData['newIcon']  = '3ea307c224811d55048d72b5696895eb';
            $categoryData['newImage'] = '3ea307c224811d55048d72b5696895eb';

            $nameCategoryTags = (new CategoryTagModel())
                ->select('categoryTagName')
                ->where('categoryId', $categoryId)
                ->findAll();

            $nameCategoryTags  = array_column($nameCategoryTags, 'categoryTagName');
            $inputCategoryTags = explode(',', $categoryData['categoryTags']);

            $newCategoryTags = array_diff($inputCategoryTags, $nameCategoryTags);

            $categoryTagsToDelete = (new CategoryTagModel())
                ->select('categoryTagId')
                ->where('categoryId', $categoryId)
                ->whereNotIn('categoryTagName', $inputCategoryTags)
                ->findAll();

            $categoryDataToUpdate = [
                'categoryName'         => $categoryData['categoryName'],
                'newCategoryTags'      => $newCategoryTags,
                'categoryTagsToDelete' => array_column($categoryTagsToDelete, 'categoryTagId'),
            ];

            (new CategoryModel())->updateCategory($categoryId, $categoryDataToUpdate);

            $response = [
                'title'   => 'Categoría actualizada',
                'message' => 'La categoría ha sido actualizada correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/categorias')->with('response', $response);
        } catch (InvalidInputException $th) {
            return redirect()->to("/admin/categorias/editar/{$categoryId}")->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al actualizar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to("/admin/categorias/editar/{$categoryId}")->withInput()->with('response', $response);
        }
    }

    public function deleteCategory()
    {
        try {
            $categoryId = $this->request->getPost('categoryId') ?? '';

            (new CategoryModel())->deleteCategory($categoryId);
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'La categoría ha sido eliminada correctamente',
                'type'    => 'success',
            ];
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al eliminar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];
        }

        return redirect()->to('admin/categorias')->with('response', $response);
    }
}
