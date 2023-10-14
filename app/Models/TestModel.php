<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'testId';
    protected $allowedFields = ['testId', 'testName'];
}