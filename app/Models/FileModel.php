<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'files';
    protected $primaryKey    = 'fileId';
    protected $allowedFields = ['fileRoute', 'uuid', 'fileName', 'fileDirectoryRoute'];
}
