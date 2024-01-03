<?php

namespace App\Models;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;
use Throwable;

class HomeSectionModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'home_page';
    protected $primaryKey    = 'homePageId';
    protected $allowedFields = ['aboutUsText', 'aboutUsImageId', 'aboutUsVideoId'];

    public function updateData($homeSectionData)
    {
        try {
            $this->db->transException(true)->transStart();
            $fileModel = new FileModel();

            if (! empty($homeSectionData['aboutUsImage'])) {
                $homeSectionData['aboutUsImageId'] = $fileModel->insert(['uuid' => $homeSectionData['aboutUsImage'][0]]);
            }

            if (! empty($homeSectionData['aboutUsVideo'])) {
                $homeSectionData['aboutUsVideoId'] = $fileModel->insert(['uuid' => $homeSectionData['aboutUsVideo'][0]]);
            }

            $this->save($homeSectionData);

            if (isset($homeSectionData['delete-aboutUsImage'])) {
                $fileModel->where('uuid', $homeSectionData['delete-aboutUsImage'][0])->delete();
            }

            if (isset($homeSectionData['delete-aboutUsVideo'])) {
                $fileModel->where('uuid', $homeSectionData['delete-aboutUsVideo'][0])->delete();
            }

            $this->db->transCommit();
        } catch (DatabaseException $th) {
            $this->db->transRollback();

            throw $th;
        }
    }

    public function getData()
    {
        try {
            $aboutUsData = $this->first();
            $fileModel   = new FileModel();

            $aboutUsData['aboutUsImage'] = $fileModel->select('uuid')->where('fileId', $aboutUsData['aboutUsImageId'] ?? '')->first()['uuid'] ?? '';
            $aboutUsData['aboutUsVideo'] = $fileModel->select('uuid')->where('fileId', $aboutUsData['aboutUsVideoId'] ?? '')->first()['uuid'] ?? '';

            return $aboutUsData;
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
