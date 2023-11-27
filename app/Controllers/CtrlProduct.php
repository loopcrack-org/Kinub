<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Exception;
use Throwable;

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
        try {
            $productId    = $this->request->getPost('productId');
            $productModel = new ProductModel();
            $product      = $productModel->find($productId);

            if (empty($product)) {
                throw new Exception();
            }

            $productModel->deleteProduct($productId);

            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha elimnado el certificado correctamente',
                'type'    => 'success',
            ];

            return redirect()->back()->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title'   => '¡Oops! Ha ocurrido un error.',
                'message' => 'Algo salio mal al eliminar el certificado. Por favor, inténtalo de nuevo.',
                'type'    => 'error',
            ];

            return redirect()->back()->with('response', $response);
        }
    }
}
