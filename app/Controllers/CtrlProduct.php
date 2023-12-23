<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class CtrlProduct extends CtrlApiFiles
{
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        $configBuilder = new FileValidationConfigBuilder('/admin/products');
        $configBuilder->builder('mainImage')->isImage()->build();
        $configBuilder->builder('image')->isImage()->build();
        $configBuilder->builder('video')->isVideo()->build();
        $configBuilder->builder('brochure')->isPDF()->build();
        $configBuilder->builder('certificate')->isPDF()->build();
        $configBuilder->builder('userManual')->isPDF()->build();
        $configBuilder->builder('datasheet')->isPDF()->build();
        $this->fileConfig = $configBuilder->getConfig();
    }

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
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        }

        $categories = (new CategoryModel())->select(['categoryId', 'categoryName'])->findAll();

        return view('admin/products/ProductCreate', [
            'fileConfig' => $this->fileConfig->getClientConfig(),
            'categories' => $categories,
        ]);
    }

    public function viewProductEdit($id)
    {
        return view('admin/products/ProductEdit', ['id' => $id]);
    }

    public function createProduct()
    {
        $passed = false;
        if ($passed) {
            $response = [
                'title'   => 'Creación exitosa',
                'message' => 'Se ha creado el producto correctamente',
                'type'    => 'success',
            ];

            return redirect()->to('/admin/productos')->with('response', $response);
        }

        return redirect()->to('/admin/productos/crear')->withInput();
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
