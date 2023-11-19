<?php

namespace App\Controllers;

use App\Models\ProductModel;

class CtrlProduct extends BaseController
{
    public function viewProducts()
    {
        $productModel = new ProductModel();
        $products     = $productModel->getAllProducts();

        return view('admin/products/Products', [
            'products' => $products,
        ]);
    }

    public function viewProductCreate()
    {
        return view('admin/products/ProductCreate');
    }

    public function viewProductEdit($id)
    {
        return view('admin/products/ProductsEdit', ['id' => $id]);
    }

    public function createProduct()
    {
        return 'creating product...';
    }

    public function updateProduct($id)
    {
        return "updating product... {$id}";
    }

    public function deleteProduct()
    {
        return 'delete product ...';
    }
}
