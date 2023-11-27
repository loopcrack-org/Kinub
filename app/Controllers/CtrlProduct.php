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
        return view('admin/products/ProductEdit', ['id' => $id]);
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
        $isDeleted = true;
        if ($isDeleted) {
            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el producto correctamente',
                'type'    => 'success',
            ];
        } else {
            $response = [
                'title'   => 'Eliminación fallida',
                'message' => 'Algo salio mal al eliminar el producto. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
