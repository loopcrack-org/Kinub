<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Libraries\tinify\Tinify;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Utils\FileManager;
use App\Validation\ProductValidation;
use Throwable;

class CtrlProduct extends CtrlApiFiles
{
    private static $PRODUCTS_BASE_ROUTE;
    private static $PRODUCTS_CREATE_ROUTE;
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        self::$PRODUCTS_BASE_ROUTE   = url_to(self::class . '::viewProducts');
        self::$PRODUCTS_CREATE_ROUTE = url_to(self::class . '::viewProductCreate');

        $configBuilder = new FileValidationConfigBuilder('/admin/productos');
        $configBuilder->builder('mainImage')->isImage()->minFiles(1)->maxFiles(1)->maxSize(2, 'MB')->maxDims(500, 800)->build();
        $configBuilder->builder('mainVideo')->isVideo()->minFiles(1)->maxFiles(1)->maxSize(10000, 'MB')->build();
        $configBuilder->builder('galleryImages')->isImage()->maxSize(2, 'MB')->maxDims(1200, 1200)->allowMultipleFiles()->build();
        $configBuilder->builder('galleryVideos')->isVideo()->allowMultipleFiles()->maxSize(500, 'MB')->build();
        $configBuilder->builder('brochures')->isPDF()->maxSize(1, 'MB')->allowMultipleFiles()->build();
        $configBuilder->builder('certificates')->isPDF()->maxSize(5, 'MB')->allowMultipleFiles()->build();
        $configBuilder->builder('userManuals')->isPDF()->maxSize(5, 'MB')->allowMultipleFiles()->build();
        $configBuilder->builder('datasheets')->isPDF()->maxSize(2, 'MB')->allowMultipleFiles()->build();
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
        $productModel = new ProductModel();
        $product      = $productModel->getProductById($id);
        $categories   = (new CategoryModel())->select(['categoryId', 'categoryName'])->findAll();

        // return json_encode($product);
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        } else {
            $this->fileConfig->setDataInClientConfig($product['files']);
            unset($product['files']);
        }

        return view('admin/products/ProductEdit', [
            'fileConfig' => $this->fileConfig->getClientConfig(),
            'product'    => $product,
            'categories' => $categories,
        ]);
    }

    public function createProduct()
    {
        try {
            $productData                         = $this->request->getPost();
            $productData['productTechnicalInfo'] = json_encode($productData['productTechnicalInfo']);

            $validator = new ProductValidation();
            $fileRules = $this->fileConfig->getCollectionFileValidationRules();

            $validator->addRules($fileRules['rules'], $fileRules['messages']);

            $dataIsIncorrect = ! $validator->validateInputs($productData) || ! $validator->existCategoryId($productData['productCategoryId']);

            if ($dataIsIncorrect) {
                throw new InvalidInputException($validator->getErrors());
            }

            (new ProductModel())->createProduct($productData);

            $this->saveProductFiles($productData);

            $response = [
                'title'   => 'Nuevo produto creado',
                'message' => 'El producto ha sido creada correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$PRODUCTS_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            return redirect()->to(self::$PRODUCTS_CREATE_ROUTE)->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());

            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al registrar los datos, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to(self::$PRODUCTS_CREATE_ROUTE)->withInput()->with('response', $response);
        }
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

    private function saveProductFiles(array $productData)
    {
        $productFiles = $this->fileConfig->filterNewFilesInInputsFile($productData);

        foreach ($productFiles as $productFilesByInput) {
            FileManager::changeDirectoryCollectionFolder($productFilesByInput);
            Tinify::convertImages($productFilesByInput);
        }
    }
}
