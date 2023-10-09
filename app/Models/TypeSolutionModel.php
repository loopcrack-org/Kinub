<?php

namespace App\Models;

use CodeIgniter\Model;

class MeasurementSolutionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'type_solutions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ["msName", "msDescription", "msImageId", "msIconId"];
}
