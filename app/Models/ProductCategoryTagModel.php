<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryTagModel extends Model
{
    protected $table         = 'products-category_tags';
    protected $primaryKey    = 'pctId';
    protected $allowedFields = ['pctProductId', 'pctCategoryTagId'];

    public function getProductCategoryTagIdByProductId($productId)
    {
        $tags = $this->select('category_tags.categoryTagId')
            ->join('category_tags', 'category_tags.categoryTagId = products-category_tags.pctCategoryTagId')
            ->where('products-category_tags.pctProductId', $productId)
            ->findAll();

        return array_map(static fn ($tag) => $tag['categoryTagId'], $tags);
    }

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
