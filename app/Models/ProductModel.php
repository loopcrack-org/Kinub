<?php

namespace App\Models;

use CodeIgniter\Model;

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
}
