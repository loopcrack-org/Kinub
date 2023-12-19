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

    public function createMeasurementSolution(array $msData)
    {
        try {
            $this->db->transException(true)->transStart();

            $fileModel = new FileModel();

            $msData['msIconId']  = $fileModel->insert(['uuid' => $msData['msIcon'][0]]);
            $msData['msImageId'] = $fileModel->insert(['uuid' => $msData['msImage'][0]]);

            $this->insert($msData);
            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function getMeasurementSolutionDataWithFiles(string $msId)
    {
        $msData = $this->find($msId);

        $fileModel = new FileModel();

        $msData['msIcon']  = $fileModel->select('uuid')->where('fileId', $msData['msIconId'] ?? '')->first()['uuid'] ?? '';
        $msData['msImage'] = $fileModel->select('uuid')->where('fileId', $msData['msImageId'] ?? '')->first()['uuid'] ?? '';

        return $msData;
    }

    public function updateMeasurementSolution(string $msId, array $msData)
    {
        try {
            $this->db->transException(true)->transStart();

            $fileModel = new FileModel();

            if (! empty($msData['msIcon'])) {
                $msData['msIconId'] = $fileModel->insert(['uuid' => $msData['msIcon'][0]]);
            }

            if (! empty($msData['msImage'])) {
                $msData['msImageId'] = $fileModel->insert(['uuid' => $msData['msImage'][0]]);
            }

            $this->update($msId, $msData);

            if (isset($msData['delete-msIcon'])) {
                $fileModel->where('uuid', $msData['delete-msIcon'][0])->delete();
            }

            if (isset($msData['delete-msImage'])) {
                $fileModel->where('uuid', $msData['delete-msImage'][0])->delete();
            }

            $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function deleteMeasuremenSolution(array $msData)
    {
        try {
            $this->db->transException(true)->transStart();

            $fileModel = new FileModel();

            $fileModel->delete($msData['msIconId']);
            $fileModel->delete($msData['msImageId']);

            return $this->db->transCommit();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
