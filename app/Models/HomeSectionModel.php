<?php

namespace App\Models;

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
            $this->db->transStart();
            $fileModel                         = new FileModel();
            $homeSectionData['aboutUsImageId'] = $fileModel->insert(['uuid' => $homeSectionData['aboutUsImage']]);
            $homeSectionData['aboutUsVideoId'] = $fileModel->insert(['uuid' => $homeSectionData['aboutUsVideo']]);
            $this->save($homeSectionData);

            if (isset($homeSectionData['delete-aboutUsImage'])) {
                $fileModel->where('uuid', $homeSectionData['delete-aboutUsImage']);
            }

            if (isset($homeSectionData['delete-aboutUsVideo'])) {
                $fileModel->where('uuid', $homeSectionData['delete-aboutUsImage']);
            }

            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
