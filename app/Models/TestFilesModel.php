<?php

namespace App\Models;

use CodeIgniter\Model;

class TestFilesModel extends Model
{
    protected $table = 'test_files';
    protected $primaryKey = 'testFilesId';
    protected $allowedFields = ['fileId', 'testId', 'fileType'];

    public function createNewFile($folderData, $testId, $type)
    {
        try {
            $this->db->transStart();
            $fileModel = new FileModel();
            $fileModelId = $fileModel->insert($folderData, true);
            $this->insert(["fileId" => $fileModelId, 'testId' => $testId, "fileType" => $type]);
            $this->db->transComplete();
        } catch (\Throwable $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

}
