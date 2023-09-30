<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'categoryId';
    protected $allowedFields    = ["name", "imageId", "iconId"];
}
