<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductFilesModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'product_files';
    protected $primaryKey    = 'pfId';
    protected $allowedFields = ['pfProductId', 'pfFileId', 'pfFileType'];

    public function getFilesByProductId($productId)
    {
        return $this->select('*')
            ->join('files', 'files.fileId = product_files.pfFileId', 'LEFT')
            ->where('product_files.pfProductId', $productId)
            ->findAll();
    }
}
