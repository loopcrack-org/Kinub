<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Utils\FileUtils;

class TestFilesModel extends Model
{
    protected $table = 'test_files';
    protected $primaryKey = 'testFilesId';
    protected $allowedFields = ['fileId', 'testId', 'fileType'];

    public function saveFiles($files, $testId, $type)
    {

        if (empty($files)) {
            return;
        }

        $fileModel = new FileModel();
        $fileModel->insertBatch(FileUtils::getFileEntities($files));
        $lastFilesIds = $fileModel->getLastIds();
        $data = [];
        foreach($lastFilesIds as $fileInsertedId) {
            $data[] = ["fileId" => $fileInsertedId['fileId'], 'testId' => $testId, "fileType" => $type];
        }

        $this->insertBatch($data);
    }

    public function deleteFiles($keyFiles)
    {
        try {
            $this->db->transStart();
            foreach($keyFiles as $keyFile) {
                $fileModel = new FileModel();
                $fileModel->where("uuid", $keyFile)->delete();
            }
            $this->db->transComplete();
        } catch (\Throwable $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

}