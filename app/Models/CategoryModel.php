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

    public function updateCategory(string $categoryId, array $categoryData)
    {
        try {
            $this->db->transStart();

            if ($categoryData['newCategoryTags']) {
                $newCategortTags = array_map(static function ($categoryTag) use ($categoryId) {
                    return [
                        'categoryTagName' => $categoryTag,
                        'categoryId'      => $categoryId,
                    ];
                }, $categoryData['newCategoryTags']);

                (new CategoryTagModel())->insertBatch($newCategortTags);
            }

            if ($categoryData['categoryTagsToDelete']) {
                $categoryTagModel = new CategoryTagModel();
                $categoryTagModel->delete($categoryData['categoryTagsToDelete']);
            }

            (new CategoryModel())->update($categoryId, $categoryData);
            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    /**
     * get the image asociated with a category
     *
     * @param int|string $categoryId the category id to get the background image
     *
     * @return string
     */
    public function getBackgroundImage(int|string $categoryId)
    {
        $imageId   = $this->select('categoryImageId')->where('categoryId', $categoryId)->first()['categoryImageId'];
        $fileModel = new FileModel();

        return $fileModel->find($imageId);
    }
}
