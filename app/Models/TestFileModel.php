<?php

namespace App\Models;

use CodeIgniter\Model;

class TestFileModel extends Model
{
    protected $table = 'test_files';
    protected $primaryKey = 'testFileId';
    protected $allowedFields = ['fileId', 'type'];
}