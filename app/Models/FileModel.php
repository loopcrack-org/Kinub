<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'fileId';
    protected $allowedFields = ['fileRoute', 'uuid', 'fileDirectoryRoute', 'fileName'];

}
