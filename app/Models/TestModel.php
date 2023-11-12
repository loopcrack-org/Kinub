<?php

namespace App\Models;

use CodeIgniter\Debug\Toolbar\Collectors\Files;
use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'testId';
    protected $allowedFields = ['testId', 'testName'];

    public function getKeyFilesByType($id, $type)
    {
        $result = $this->select("uuid")
            ->join("test_files", "test.testId=test_files.testId")
            ->join("files", "test_files.fileId=files.fileId")
            ->where("test.testId", $id)->where("test_files.fileType", $type)
            ->findAll();
        return array_map(function ($file) {
            return $file["uuid"];
        }, $result);
    }

    public function getKeyFiles($id)
    {
        $result = $this->select("uuid")
                    ->join("test_files", "test.testId=test_files.testId")
                    ->join("files", "test_files.fileId=files.fileId")
                    ->where("test.testId", $id)
                    ->groupBy('test_files.fileId')
                    ->findAll();
        return $result;
    }
}
