<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class CategoryModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'categories';
    protected $primaryKey    = 'categoryId';
    protected $allowedFields = ['categoryName', 'categoryImageId', 'categoryIconId'];

    public function createCategory(array $categoryData)
    {
        try {
            $this->db->transStart();

            $fileModel                       = new FileModel();
            $categoryData['categoryIconId']  = $fileModel->insert(['uuid' => $categoryData['icon']]);
            $categoryData['categoryImageId'] = $fileModel->insert(['uuid' => $categoryData['image']]);
            $categoryId                      = $this->insert($categoryData);

            $categoryTags = array_map(static function ($categoryTag) use ($categoryId) {
                return [
                    'categoryTagName' => $categoryTag,
                    'categoryId'      => $categoryId,
                ];
            }, explode(',', $categoryData['categoryTags']));

            (new CategoryTagModel())->insertBatch($categoryTags);
            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
