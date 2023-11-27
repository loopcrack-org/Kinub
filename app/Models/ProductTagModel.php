<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductTagModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'product_tags';
    protected $primaryKey    = 'ptId';
    protected $allowedFields = ['ptName', 'ptProductId'];
}
