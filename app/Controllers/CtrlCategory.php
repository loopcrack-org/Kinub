<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Libraries\tinify\Tinify;
use App\Models\CategoryModel;
use App\Models\CategoryTagModel;
use App\Utils\FileManager;
use App\Validation\CategoryValidation;
use Throwable;

class CtrlCategory extends CtrlApiFiles
{
    private static $CATEGORIES_BASE_ROUTE;
    private static $CATEGORIES_CATEGORY_CREATE;
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        self::$CATEGORIES_BASE_ROUTE      = url_to(self::class . '::viewCategories');
        self::$CATEGORIES_CATEGORY_CREATE = url_to(self::class . '::viewCategoryCreate');

        $fileConfigBuilder = new FileValidationConfigBuilder('/admin/categorias');
        $fileConfigBuilder->builder('icon')->isSVG()->maxFiles(1)->minFiles(1)->maxSize(5, 'KB')->build();
        $fileConfigBuilder->builder('image')->isImage()->maxFiles(1)->minFiles(1)->maxSize(1, 'MB')->maxDims(1600, 500)->build();

        $this->fileConfig = $fileConfigBuilder->getConfig();
    }

    public function viewCategories()
    {
        $categories = (new CategoryModel())->getAllCategories();

        return view('admin/categories/Categories', ['categories' => $categories]);
    }

    public function viewCategoryCreate()
    {
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        }

        return view('admin/categories/CategoryCreate', ['filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    public function viewCategoryEdit($id)
    {
        if (session()->has('clientData')) {
            $category = session()->get('clientData');
            $this->fileConfig->setDataInClientConfig($category);
        } else {
            $category               = (new CategoryModel())->getCategoryById($id);
            $categoryFiles['icon']  = [$category['icon']];
            $categoryFiles['image'] = [$category['image']];

            $this->fileConfig->setDataInClientConfig($categoryFiles);
        }

        return view('admin/categories/CategoryEdit', ['category' => $category, 'filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    public function createCategory()
    {
        try {
            $categoryData        = $this->request->getPost();
            $fileValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validator           = new CategoryValidation();
            $validator->addRules($fileValidationRules['rules'], $fileValidationRules['messages']);

            if (! $validator->validateInputs($categoryData)) {
                throw new InvalidInputException($validator->getErrors());
            }

            (new CategoryModel())->createCategory($categoryData);

            FileManager::changeDirectoryFolder(FILES_TEMP_DIRECTORY . $categoryData['icon'][0], FILES_UPLOAD_DIRECTORY . $categoryData['icon'][0]);
            FileManager::changeDirectoryFolder(FILES_TEMP_DIRECTORY . $categoryData['image'][0], FILES_UPLOAD_DIRECTORY . $categoryData['image'][0]);
            Tinify::convertImages($categoryData['image']);

            $response = [
                'title'   => 'Nueva categoría creada',
                'message' => 'La categoría ha sido creada correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$CATEGORIES_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            return redirect()->to(self::$CATEGORIES_CATEGORY_CREATE)->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al guardar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to(self::$CATEGORIES_CATEGORY_CREATE)->withInput()->with('response', $response);
        }
    }

    public function updateCategory(string $categoryId)
    {
        try {
            $categoryData        = $this->request->getPost();
            $fileValidationRules = $this->fileConfig->getCollectionFileValidationRules();
            $validator           = new CategoryValidation();
            $validator->addRules($fileValidationRules['rules'], $fileValidationRules['messages']);

            if (! $validator->validateInputs($categoryData)) {
                throw new InvalidInputException($validator->getErrors());
            }

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

            $newFiles      = $this->fileConfig->filterNewFilesInInputsFile($categoryData);
            $filesToDelete = $this->fileConfig->getKeysFolderToDelete($categoryData);

            $categoryDataToUpdate = [
                'categoryName'         => $categoryData['categoryName'],
                'categorySubname'      => $categoryData['categorySubname'],
                'newCategoryTags'      => $newCategoryTags,
                'categoryTagsToDelete' => array_column($categoryTagsToDelete, 'categoryTagId'),
                'newIcon'              => $newFiles['icon'][0] ?? '',
                'iconToDelete'         => $filesToDelete['icon'][0] ?? '',
                'newImage'             => $newFiles['image'][0] ?? '',
                'imageToDelete'        => $filesToDelete['image'][0] ?? '',
            ];

            (new CategoryModel())->updateCategory($categoryId, $categoryDataToUpdate);

            foreach ($newFiles as $keyFiles) {
                FileManager::changeDirectoryCollectionFolder($keyFiles);
                Tinify::convertImages($keyFiles);
            }

            foreach ($filesToDelete as $keyFilesToDelete) {
                FileManager::deleteMultipleFoldersWithContent($keyFilesToDelete);
            }

            $response = [
                'title'   => 'Categoría actualizada',
                'message' => 'La categoría ha sido actualizada correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$CATEGORIES_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            return redirect()->to(url_to(self::class . '::viewCategoryEdit', $categoryId))->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al actualizar los datos de la categoría, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to(url_to(self::class . '::viewCategoryEdit', $categoryId))->withInput()->with('response', $response);
        }
    }

    public function deleteCategory()
    {
        try {
            $categoryId    = $this->request->getPost('categoryId') ?? '';
            $categoryFiles = (new CategoryModel())->deleteCategory($categoryId);

            FileManager::deleteFolderWithContent(FILES_UPLOAD_DIRECTORY . $categoryFiles['image']);
            FileManager::deleteFolderWithContent(FILES_UPLOAD_DIRECTORY . $categoryFiles['icon']);

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

        return redirect()->to(self::$CATEGORIES_BASE_ROUTE)->with('response', $response);
    }
}
