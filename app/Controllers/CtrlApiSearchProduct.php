<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\HTTP\Response;
use Throwable;

class CtrlApiSearchProduct extends BaseController
{
    public function getProducts()
    {
        try {
            $request      = $this->request;
            $search       = (string) $request->getGet('search');
            $categories   = $request->getGet('category');
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

            $productModel = new ProductModel();
            $products     = $productModel->filterProducts(
                categories: $categories,
                categoryTags: $categoryTags,
                productTags: $productTags,
                search: $search
            )->order($orderBy, $direction)->getByPage($page, $perPage);

            return json_encode($products);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error en el filtro'));
        }
    }
}
