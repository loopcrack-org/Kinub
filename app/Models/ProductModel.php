<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class ProductModel extends Model
{
    protected $DBGroup        = 'default';
    protected $table          = 'products';
    protected $primaryKey     = 'productId';
    protected $allowedFields  = ['productName', 'productModel', 'productDescription', 'productDetails', 'productTechnicalInfo', 'productCategoryId'];
    private $productFileTypes = [
        'mainImage'     => 'main Image',
        'mainVideo'     => 'video demo',
        'galleryImages' => 'image',
        'galleryVideos' => 'video',
        'brochures'     => 'brochure',
        'userManuals'   => 'user manual',
        'certificates'  => 'product certificate',
        'datasheets'    => 'datasheet',
    ];

    public function getAllProducts()
    {
        return $this->select('productId, productName, productModel, categoryName, fileRoute')
            ->join('product_files', 'product_files.pfProductId = products.productId')
            ->join('files', 'files.fileId = product_files.pfFileId')
            ->join('categories', 'categories.categoryId = products.productCategoryId')
            ->where('pfFileType', 'main image')
            ->findAll();
    }

    public function createProduct(array $productData)
    {
        try {
            $this->db->transException(true)->transStart();

            $productId = $this->insert($productData);

            (new ProductTagModel())->createProductTags($productId, explode(',', $productData['productTags']));
            (new ProductCategoryTagModel())->createProductCategoryTags($productId, $productData['categoryTags']);

            $productFiles = [];

            foreach ($this->productFileTypes as $key => $productType) {
                $productFiles = array_merge($productFiles, $this->saveProductFiles($productId, $productData[$key], $productType));
            }

            (new ProductFilesModel())->insertBatch($productFiles);

            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    private function saveProductFiles(string $productId, array $files, string $fileType)
    {
        $fileModel = new FileModel();

        return array_map(static function ($file) use ($productId, $fileModel, $fileType) {
            return [
                'pfProductId' => $productId,
                'pfFileId'    => $fileModel->insert(['uuid' => $file]),
                'pfFileType'  => $fileType,
            ];
        }, $files);
    }
}
