<?php

namespace App\Models;

use Ausi\SlugGenerator\SlugGenerator;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;
use Throwable;

class CategoryModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'categories';
    protected $primaryKey    = 'categoryId';
    protected $allowedFields = ['categoryName', 'categorySubname', 'categorySlug', 'categoryImageId', 'categoryIconId'];

    public function getAllCategories()
    {
        return $this->select('categoryName, categoryId, fileRoute')
            ->join('files', 'fileId = categoryIconId')
            ->findAll();
    }

    public function getCategoryById(string $categoryId)
    {
        $category                 = $this->find($categoryId);
        $tags                     = (new CategoryTagModel())->select('categoryTagName')->where('categoryId', $categoryId)->findAll();
        $category['categoryTags'] = implode(',', array_column($tags, 'categoryTagName'));

        $fileModel         = new FileModel();
        $category['icon']  = $fileModel->select('uuid')->find($category['categoryIconId'])['uuid'];
        $category['image'] = $fileModel->select('uuid')->find($category['categoryImageId'])['uuid'];

        return $category;
    }

    public function createCategory(array $categoryData)
    {
        try {
            $this->db->transException(true)->transStart();
            $slugGenerator = new SlugGenerator();

            $fileModel                       = new FileModel();
            $categoryData['categoryIconId']  = $fileModel->insert(['uuid' => $categoryData['icon'][0]]);
            $categoryData['categoryImageId'] = $fileModel->insert(['uuid' => $categoryData['image'][0]]);
            $categoryData['categorySlug']    = $slugGenerator->generate($categoryData['categoryName']);
            $categoryId                      = $this->insert($categoryData);

            $categoryTags = array_map(static function ($categoryTag) use ($categoryId, $slugGenerator) {
                return [
                    'categoryTagName' => $categoryTag,
                    'categoryTagSlug' => $slugGenerator->generate($categoryTag),
                    'categoryId'      => $categoryId,
                ];
            }, explode(',', $categoryData['categoryTags']));

            (new CategoryTagModel())->insertBatch($categoryTags);

            $this->db->transCommit();
        } catch (DatabaseException $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function updateCategory(string $categoryId, array $categoryData)
    {
        try {
            $this->db->transException(true)->transStart();
            $slugGenerator                = new SlugGenerator();
            $categoryData['categorySlug'] = $slugGenerator->generate($categoryData['categoryName']);

            if ($categoryData['newCategoryTags']) {
                $newCategoryTags = array_map(static function ($categoryTag) use ($categoryId, $slugGenerator) {
                    return [
                        'categoryTagName' => $categoryTag,
                        'categoryTagSlug' => $slugGenerator->generate($categoryTag),
                        'categoryId'      => $categoryId,
                    ];
                }, $categoryData['newCategoryTags']);

                (new CategoryTagModel())->insertBatch($newCategoryTags);
            }

            $fileModel = new FileModel();
            if ($categoryData['newIcon']) {
                $fileModel->where('uuid', $categoryData['iconToDelete'])->delete();
                $categoryData['categoryIconId'] = $fileModel->insert(['uuid' => $categoryData['newIcon']]);
            }

            if ($categoryData['newImage']) {
                $categoryData['categoryImageId'] = $fileModel->insert(['uuid' => $categoryData['newImage']]);
                $fileModel->where('uuid', $categoryData['imageToDelete'])->delete();
            }

            if ($categoryData['categoryTagsToDelete']) {
                $categoryTagModel = new CategoryTagModel();
                $categoryTagModel->delete($categoryData['categoryTagsToDelete']);
            }

            (new CategoryModel())->update($categoryId, $categoryData);
            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function deleteCategory(string $categoryId)
    {
        try {
            $this->db->transException(true)->transStart();
            $categoryData = $this->find($categoryId);
            $this->delete($categoryId);

            $fileModel = new FileModel();

            $categoryFiles['icon']  = $fileModel->select('uuid')->find($categoryData['categoryIconId'])['uuid'];
            $categoryFiles['image'] = $fileModel->select('uuid')->find($categoryData['categoryImageId'])['uuid'];

            $fileModel->delete($categoryData['categoryImageId']);
            $fileModel->delete($categoryData['categoryIconId']);

            $this->db->transCommit();

            return $categoryFiles;
        } catch (DatabaseException $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
