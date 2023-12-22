<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class MeasurementSolutionModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'measurement_solutions';
    protected $primaryKey    = 'msId';
    protected $allowedFields = ['msName', 'msDescription', 'msImageId', 'msIconId'];

    public function updateMeasurementSolution(string $msId, array $msData)
    {
        try {
            $this->db->transStart();

            $msData['msImageId'] = 1;
            $msData['msIconId']  = 2;

            $this->update($msId, $msData);

            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function getMeasurementSolutionsWithFiles()
    {
        return $this->select('measurement_solutions.msId, measurement_solutions.msName,
                measurement_solutions.msDescription,
                msImg.fileRoute AS msImageRoute, msImg.fileName AS msImageName,
                msIcon.fileRoute AS msIconRoute, msIcon.fileName AS msIconName')->join('files msImg', 'measurement_solutions.msImageId = msImg.fileId', 'left')->join('files msIcon', 'measurement_solutions.msIconId = msIcon.fileId', 'left')->findAll();
    }
}
