<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductFilesModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'product_files';
    protected $primaryKey    = 'pfId';
    protected $allowedFields = ['pfProductId', 'pfFileId', 'pfFileType'];
}
