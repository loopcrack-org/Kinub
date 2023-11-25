<?php

namespace App\Models;

use App\Utils\FileUtils;
use CodeIgniter\Model;
use Throwable;

class TestFilesModel extends Model
{
    protected $table         = 'test_files';
    protected $primaryKey    = 'testFilesId';
    protected $allowedFields = ['fileId', 'testId', 'fileType'];

    /**
     * save files on database with a specific type
     *
     * @param array  $files  the array of key files from post
     * @param string $testId the id for the test register on database
     * @param string $type   the filetype for all files to save
     */
    public function saveFiles($files, $testId, $type)
    {
        if (empty($files)) {
            return;
        }

        $fileModel = new FileModel();
        $fileModel->insertBatch(FileUtils::getFileEntities($files));
        $lastFilesIds = $fileModel->getLastIds();
        $data         = [];

        foreach ($lastFilesIds as $fileInsertedId) {
            $data[] = ['fileId' => $fileInsertedId['fileId'], 'testId' => $testId, 'fileType' => $type];
        }

        $this->insertBatch($data);
    }

    /**
     * Delete all files with their key files
     *
     * @param array $keyFiles the array of key files
     */
    public function deleteFiles($keyFiles)
    {
        try {
            $this->db->transStart();

            foreach ($keyFiles as $keyFile) {
                $fileModel = new FileModel();
                $fileModel->where('uuid', $keyFile)->delete();
            }
            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
