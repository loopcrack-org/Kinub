<?php

namespace App\Models;

use CodeIgniter\Debug\Toolbar\Collectors\Files;
use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'testId';
    protected $allowedFields = ['testId', 'testName'];

    public function getKeyFiles($id) {
        $result = $this->select("fileType, uuid")
            ->join("test_files", "test.testId=test_files.testId")
            ->join("files", "test_files.fileId=files.fileId")
            ->where("test.testId", $id)
            ->findAll();
        return $result;
    }
}