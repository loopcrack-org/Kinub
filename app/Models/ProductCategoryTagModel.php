<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryTagModel extends Model
{
    protected $table         = 'products-category_tags';
    protected $primaryKey    = 'pctId';
    protected $allowedFields = ['pctProductId', 'pctCategoryTagId'];

    public function createProductCategoryTags(string $productId, array $productCategoryTags)
    {
        $productTags = array_map(static function ($productCategoryTagId) use ($productId) {
            return [
                'pctProductId'     => $productId,
                'pctCategoryTagId' => $productCategoryTagId,
            ];
        }, $productCategoryTags);

        $this->insertBatch($productTags);
    }
}
