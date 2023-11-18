<?php

namespace App\Models;

use CodeIgniter\Model;

class MeasurementSolutionModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'measurement_solutions';
    protected $primaryKey    = 'msId';
    protected $allowedFields = ['msName', 'msDescription', 'msImageId', 'msIconId'];
}
