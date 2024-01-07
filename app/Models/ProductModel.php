<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'productId';
    protected $allowedFields    = ['productName', 'productModel', 'productDescription', 'productTechnicalInfo', 'productCategoryId'];
    private $allowedFilterOrder = [
        'name'      => 'productName',
        'relevance' => 'productRelevance',
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
    public function filterProducts(array $categories, array $categoryTags, array $productTags, string $search = '')
    {
        $this->buildBaseFilterQuery();

        $this->applyFilter('categories.categorySlug', $categories);
        $this->applyFilter('category_tags.categoryTagSlug', $categoryTags);
        $this->applyFilter('product_tags.ptSlug', $productTags);
        $this->filterBySearch($search);

        $this->groupBy('productId');

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
    public function order(string $orderType = 'name', string $order = 'asc')
    {
        $this->orderBy(in_array($orderType, $this->allowedFilterOrder, true) ? $orderType : $this->allowedFilterOrder['name'], $order);

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
    public function findByPage(int $page = 1, int $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        return $this->findAll(limit: $perPage, offset: $offset);
    }

    /**
     * Build a base joins to filter by products
     */
    private function buildBaseFilterQuery()
    {
        $this->select([
            'productName',
            'productModel',
            'categoryName',
            'CONCAT("/producto/", productId, "/", productName) AS productUrl',
            'GROUP_CONCAT(DISTINCT files.fileRoute) AS imageRoute',
        ])
            ->join('categories', 'products.productCategoryId = categories.categoryId')
            ->join('`products-category_tags`', 'products.productId = `products-category_tags`.pctProductId', 'LEFT')
            ->join('category_tags', 'category_tags.categoryTagId = `products-category_tags`.pctCategoryTagId', 'LEFT')
            ->join('product_tags', 'product_tags.ptProductId = products.productId', 'LEFT')
            ->join('product_files', new RawSql('products.productId = product_files.pfProductId AND product_files.pfFileType = "main image"'), 'LEFT')
            ->join('files', 'product_files.pfFileId = files.fileId', 'LEFT');
    }

    /**
     * Apply a filter to a field on model
     *
     * @param string $fieldName the name on filter apply
     * @param array  $values    the values to filter
     */
    private function applyFilter(string $fieldName, array $values)
    {
        if (! empty($values)) {
            $this->whereIn($fieldName, $values);
        }
    }

    /**
     * Apply a filter on productName and productModel
     *
     * @param string $search the search to filter
     */
    private function filterBySearch(string $search)
    {
        if (! empty($search)) {
            $this->groupStart()
                ->like('products.productName', $search)
                ->orLike('products.productModel', $search)
                ->groupEnd();
        }
    }
}
