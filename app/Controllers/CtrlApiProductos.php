<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class CtrlApiProductos extends BaseController
{
    public function index()
    {
        $categories = (new CategoryModel())->select('categoryId, categoryName')->findAll();

        return view('public/filters', ['categories' => $categories]);
    }

    public function getProductos()
    {
        $data       = json_decode($this->request->getBody(), true);
        $categoryId = $data['categoryId'] === '' ? 'productCategoryId' : $data['categoryId'];

        if ($data['categoryId']) {
            $dataResponse = (new ProductModel())
                ->select('productName')
                ->join('products-category_tags', 'products-category_tags.pctProductId = products.productId')
                ->like('productName', "%{$data['productName']}%")
                ->where('productCategoryId', $categoryId)
                ->groupBy('productId')
                ->findAll();
        } else {
            $dataResponse = (new ProductModel())
                ->select('productName')
                ->like('productName', "%{$data['productName']}%")
                ->findAll();
        }

        return $this->response->setJSON($dataResponse);
    }
}
