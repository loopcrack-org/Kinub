<?php

namespace App\Models;

use CodeIgniter\Model;

class TestFilesModel extends Model
{
    protected $table = 'test_files';
    protected $primaryKey = 'testFilesId';
    protected $allowedFields = ['fileId', 'testId', 'fileType'];

    public function saveFiles($files, $testId, $type)
    {
        try {
            $this->db->transStart();
            foreach($files as $file) {
                $fileModel = new FileModel();
                $fileInsertedId = $fileModel->insert($file, true);
                $this->insert(["fileId" => $fileInsertedId, 'testId' => $testId, "fileType" => $type]);
            }
            $this->db->transComplete();
        } catch (\Throwable $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

}
