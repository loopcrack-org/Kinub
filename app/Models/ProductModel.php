<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class ProductModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'products';
    protected $primaryKey    = 'productId';
    protected $allowedFields = ['productName', 'productModel', 'productDescription', 'productTechnicalInfo', 'productCategoryId'];

    public function getAllProducts()
    {
        return $this->select('productId, productName, productModel, categoryName, fileRoute')->join('product_files', 'product_files.pfProductId = products.productId')->join('files', 'files.fileId = product_files.pfFileId')->join('categories', 'categories.categoryId = products.productCategoryId')->where('pfFileType', 'main image')->findAll();
    }

    public function deleteProduct($productId)
    {
        try {
            $this->db->transStart();

            (new ProductTagModel())->where('ptProductId', $productId)->delete();

            $productFilesModel = new ProductFilesModel();
            $productFilesId    = $productFilesModel->select('pfFileId')->where('pfProductId', $productId)->findAll();

            foreach ($productFilesId as $item) {
                if (isset($item['pfFileId'])) {
                    $pfFileIds[] = $item['pfFileId'];
                }
            }

            $productFilesModel->where('pfProductId', $productId)->delete();

            $fileModel = new FileModel();
            $fileModel->delete($pfFileIds);

            $this->delete($productId);

            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
