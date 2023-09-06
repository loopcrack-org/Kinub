<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeSolutionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'type_solutions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ["name", "description", "image", "icon"];
}
