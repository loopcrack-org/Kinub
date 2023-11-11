<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table            = 'emails';
    protected $primaryKey       = 'emailId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['emailTypeId', 'inquirerName', 'inquirerEmail', 'emailContent'];
}
