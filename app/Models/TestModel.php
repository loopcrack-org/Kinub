<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table         = 'test';
    protected $primaryKey    = 'testId';
    protected $allowedFields = ['testId', 'testName'];

    /**
     * get the key of files from database with a specific file type
     *
     * @param $id   the id for the test register on database
     * @param $type the type of file - (for example: image, brochure...)
     *
     * @return array
     */
    public function getKeyFilesByType($id, $type)
    {
        $result = $this->select('uuid')
            ->join('test_files', 'test.testId=test_files.testId')
            ->join('files', 'test_files.fileId=files.fileId')
            ->where('test.testId', $id)->where('test_files.fileType', $type)
            ->findAll();

        return array_map(static fn ($file) => $file['uuid'], $result);
    }

    /**
     * get al the key of files
     *
     * @param $id the id for the test register on database
     *
     * @return array
     */
    public function getKeyFiles($id)
    {
        $result = $this->select('uuid')
            ->join('test_files', 'test.testId=test_files.testId')
            ->join('files', 'test_files.fileId=files.fileId')
            ->where('test.testId', $id)
            ->groupBy('test_files.fileId')
            ->findAll();

        return array_map(static fn ($file) => $file['uuid'], $result);
    }
}
