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
    protected $afterInsert      = ['setLastIds'];
    protected $beforeInsert     = ['getFileEntity'];

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

    /**
     * get the file like an entity
     *
     * @param array $data the files to convert to entities
     *
     * @return array
     */
    protected function getFileEntity(array $data)
    {
        $uuid                               = $data['data']['uuid'];
        $outputFolder                       = str_replace('.', '', FILES_UPLOAD_DIRECTORY . $uuid);
        $sourceFolder                       = FILES_TEMP_DIRECTORY . $uuid;
        $filePath                           = scandir($sourceFolder)[2];
        $data['data']['fileRoute']          = "{$outputFolder}/{$filePath}";
        $data['data']['fileDirectoryRoute'] = $outputFolder;
        $data['data']['fileName']           = $filePath;

        return $data;
    }
}
