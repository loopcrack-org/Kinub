<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductTagModel;
use App\Validation\ApiPublicValidation;
use CodeIgniter\HTTP\Response;
use Throwable;

class CtrlApiPublic extends BaseController
{
    /**
     * get product with filters applied
     *
     * @return array
     */
    public function getProducts()
    {
        try {
            $filter    = $this->request->getGet();
            $validator = new ApiPublicValidation();

            // validation
            if (! $validator->validateInputs($filter)) {
                throw new InvalidInputException($validator->getErrors());
            }

            // default values
            $filter['categorias']     = empty($filter['categorias']) ? [] : explode(',', $filter['categorias']);
            $filter['producto-tags']  = empty($filter['producto-tags']) ? [] : explode(',', $filter['producto-tags']);
            $filter['categoria-tags'] = empty($filter['categoria-tags']) ? [] : explode(',', $filter['categoria-tags']);
            if (! isset($filter['busqueda'])) {
                $filter['busqueda'] = '';
            }
            if (! isset($filter['clasificacion'])) {
                $filter['clasificacion'] = 'id';
            }
            if (! isset($filter['orden'])) {
                $filter['orden'] = 'asc';
            }

            $productModel = new ProductModel();
            $products     = $productModel->filterProducts(
                $filter['categorias'],
                $filter['categoria-tags'],
                $filter['producto-tags'],
                $filter['busqueda']
            )->order($filter['clasificacion'], $filter['orden'])->getByPage($filter['pagina'], $filter['por-pagina']);

            return $this->response->setJSON($products);
        } catch (InvalidInputException $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'invalid request')->setJSON(['errors' => $th->getErrors()]);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'error')->setJSON(['error' => 'Ha ocurrido un error en el filtro']);
        }
    }

    /**
     * TEST FUNCTION
     *
     * the following functions are going to be removed. They are just for testing
     */
    public function getFilteredProduct()
    {
        try {
            $request      = $this->request;
            $categories   = $request->getGet('categories');
            $categoryTags = $request->getGet('categoryTags');
            $productTags  = $request->getGet('productTags');
            $perPage      = (int) $request->getGet('perPage');
            $page         = (int) $request->getGet('page');
            $orderBy      = (string) $request->getGet('orderBy');
            $direction    = (string) $request->getGet('direction');

            $emptyCategories   = empty($categories[0]);
            $emptyCategoryTags = empty($categoryTags[0]);
            $emptyProductTags  = empty($productTags[0]);

            if ($emptyCategories) {
                $categories = [];
            }
            if ($emptyCategoryTags) {
                $categoryTags = [];
            }
            if ($emptyProductTags) {
                $productTags = [];
            }
            if ($page === 0) {
                $page = 1;
            }

            $productModel = new ProductModel();
            $products     = $productModel->filterProducts(
                categories: $categories,
                categoryTags: $categoryTags,
                productTags: $productTags,
            )->order($orderBy, $direction)->getByPage($page, $perPage);

            return json_encode($products);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error en el filtro'));
        }
    }

    /**
     * just for get product tags from products asociated to a category
     */
    public function getProductTags()
    {
        $categoryIds      = $this->request->getGet('category');
        $categoryTagModel = new ProductTagModel();
        $categoryTags     = $categoryTagModel->getAllByCategories([$categoryIds]);

        return json_encode($categoryTags);
    }

    /**
     * just get background image of a category
     */
    public function getCategoryImage()
    {
        $categoryId    = (string) $this->request->getGet('category');
        $categoryModel = new CategoryModel();
        $image         = $categoryModel->getBackgroundImage($categoryId)['fileRoute'] ?? '';

        return json_encode($image);
    }
}
