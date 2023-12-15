<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup        = 'default';
    protected $table          = 'products';
    protected $primaryKey     = 'productId';
    protected $allowedFields  = ['productName', 'productModel', 'productDescription', 'productTechnicalInfo', 'productCategoryId'];
    protected $allowedOrderBy = [
        'name' => 'productName',
        'id'   => 'productId',
    ];

    /**
     * get all products
     *
     * @return array
     */
    public function getAllProducts()
    {
        return $this->select('productId, productName, productModel, categoryName, fileRoute')->join('product_files', 'product_files.pfProductId = products.productId')->join('files', 'files.fileId = product_files.pfFileId')->join('categories', 'categories.categoryId = products.productCategoryId')->where('pfFileType', 'main image')->findAll();
    }

    /**
     * Create the query for filter products by categories, categoryTags, productTags and a search by productName or productModel
     *
     * @param array  $categories   all categories to filter
     * @param array  $categoryTags all categoryTags to filter
     * @param array  $productTags  all productTags to filter
     * @param string $search       the product name or product model to filter
     *
     * @return $this
     */
    public function filterProducts(array $categories = [], array $categoryTags = [], array $productTags = [], string $search = '')
    {
        $builder = $this->select(['productId', 'productName', 'productModel'/* 'productDescription', 'productTechnicalInfo' */])
            ->join('categories', 'products.productCategoryId = categories.categoryId')
            ->join('`products-category_tags`', 'products.productId = `products-category_tags`.pctProductId', 'LEFT')
            ->join('category_tags', 'category_tags.categoryTagId = `products-category_tags`.pctCategoryTagId', 'LEFT')
            ->join('product_tags', 'product_tags.ptProductId = products.productId', 'LEFT');

        $whereQueries = [];

        if (! empty($categories)) {
            // added categories filter
            $whereQueries[] = 'categories.categoryId IN (' . implode(',', $categories) . ')';
            // added category_tags filter
            if (! empty($categoryTags)) {
                $whereQueries[] = 'category_tags.categoryTagId IN (' . implode(',', $categoryTags) . ')';
            }
            // added products_tags filter
            if (! empty($productTags)) {
                $whereQueries[] = ' product_tags.ptId IN (' . implode(',', $productTags) . ')';
            }
        }

        if (! empty($search)) {
            $whereQueries[] = "(products.productName LIKE '%{$search}%' OR products.productModel LIKE '%{$search}%')";
        }

        $builder->groupBy('productId');

        if (empty($whereQueries)) {
            return $this;
        }
        $whereQuery = implode(' AND ', $whereQueries);
        $builder->where($whereQuery);

        return $this;
    }

    /**
     * Create the query for order the consult by the allowed order types on model
     *
     * @param string $orderBy   the type order
     * @param string $direction asc or desc
     *
     * @return $this
     */
    public function order(string $orderBy = 'name', string $direction = 'asc')
    {
        if (! empty($orderBy) && isset($this->allowedOrderBy[$orderBy])) {
            $this->orderBy($this->allowedOrderBy[$orderBy], $direction);
        }

        return $this;
    }

    /**
     * Fetches and paginate all results, while optionally limiting them.
     *
     * @param int $page    the page looking for
     * @param int $perPage the registers by consult
     *
     * @return array
     */
    public function getByPage(int $page = 1, int $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        return $this->findAll(limit: $perPage, offset: $offset);
    }
}
