<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductTagModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'product_tags';
    protected $primaryKey    = 'ptId';
    protected $allowedFields = ['ptName', 'ptProductId'];

    /**
     * get all the category tags from all categories selected
     *
     * @param array $categoriesIds the categories id´s from search
     */
    public function getAllByCategories(array $categoriesIds = [])
    {
        $builder = $this->select(['ptId', 'ptName'])
            ->join('products', 'products.productId=product_tags.ptProductId')
            ->join('categories', 'categories.categoryId=products.productCategoryId');

        if (empty($categoriesIds)) {
            return $builder->findAll();
        }

        return $builder->whereIn('categoryId', $categoriesIds)->findAll();
    }
}
