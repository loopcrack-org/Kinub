<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tags';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ["idCategory", "name"];
}
