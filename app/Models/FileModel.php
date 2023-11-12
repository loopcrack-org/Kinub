<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'fileId';
    protected $allowedFields = ['fileRoute', 'uuid', 'fileDirectoryRoute', 'fileName'];
    protected $lastIds = [];

    protected $afterInsertBatch = ['setLastIds'];

    public function setLastIds(array $data)
    {
        $lastId = $this->insertID() + 1;
        $this->lastIds = $this->select('fileId')->where("fileId <= ", $lastId)->orderBy("fileId", "DESC")->limit($data['result'])->find();
        return $data;
    }

    public function getLastIds()
    {
        return $this->lastIds;
    }
}