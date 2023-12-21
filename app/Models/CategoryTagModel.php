<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryTagModel extends Model
{
    protected $table         = 'category_tags';
    protected $primaryKey    = 'categoryTagId';
    protected $allowedFields = ['categoryTagName', 'categoryId'];

    /**
     * get all the category tags from all categories selected
     *
     * @param array $categoriesIds the categories id´s from search
     *
     * @return array
     */
    public function getAllByCategories(array $categoriesIds = [])
    {
        $queryBuilder = $this->select(['categoryTagId', 'categoryTagName']);
        if (empty($categoriesIds)) {
            return $queryBuilder->findAll();
        }

        return $queryBuilder->whereIn('categoryId', $categoriesIds)->findAll();
    }
}
