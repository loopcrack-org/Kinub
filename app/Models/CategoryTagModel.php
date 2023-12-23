<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryTagModel extends Model
{
    protected $table         = 'category_tags';
    protected $primaryKey    = 'categoryTagId';
    protected $allowedFields = ['categoryTagName', 'categoryTagSlug', 'categoryId'];
}
