<?php

namespace App\Models;

use CodeIgniter\Model;

class TestFileModel extends Model
{
    protected $table = 'test_files';
    protected $primaryKey = 'testFileId';
    protected $allowedFields = ['fileId', 'type'];

    public function createNewFile($folderData, $type)
    {
        try {
            $this->db->transStart();
            $fileModel = new FileModel();
            $fileModelId = $fileModel->insert($folderData, true);
            $this->insert(["fileId" => $fileModelId, "type" => $type]);
            $this->db->transComplete();
        } catch (\Throwable $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

}
