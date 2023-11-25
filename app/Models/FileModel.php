<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * NOTE: this is a model created only for the test crud for the file configuration.
 */
class FileModel extends Model
{
    protected $table            = 'files';
    protected $primaryKey       = 'fileId';
    protected $allowedFields    = ['fileRoute', 'uuid', 'fileDirectoryRoute', 'fileName'];
    protected $lastIds          = [];
    protected $afterInsertBatch = ['setLastIds'];

    /**
     * Callback after saving files
     *
     * @param array $data the array of key files from post
     *
     * @return array
     */
    public function setLastIds(array $data)
    {
        $lastId        = $this->insertID() + 1;
        $this->lastIds = $this->select('fileId')->where('fileId <= ', $lastId)->orderBy('fileId', 'DESC')->limit($data['result'])->find();

        return $data;
    }

    /**
     * get the last Ids inserted on database
     *
     * @return array
     */
    public function getLastIds()
    {
        return $this->lastIds;
    }
}
