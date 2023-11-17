<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'products';
    protected $primaryKey    = 'productId';
    protected $allowedFields = ['productName', 'productModel', 'productDescription', 'productTechnicalInfo', 'productCategoryId'];
}
