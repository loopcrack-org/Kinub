<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table         = 'files';
    protected $primaryKey    = 'fileId';
    protected $allowedFields = ['fileRoute', 'uuid', 'fileName', 'fileDirectoryRoute'];
    protected $beforeInsert  = ['getFileEntity'];

    protected function getFileEntity(array $data)
    {
        $uuid                               = $data['data']['uuid'];
        $outputFolder                       = './uploads/' . $uuid;
        $sourceFolder                       = './files/tmp/' . $uuid;
        $filePath                           = scandir($sourceFolder)[2];
        $data['data']['fileRoute']          = "{$outputFolder}/{$filePath}";
        $data['data']['fileDirectoryRoute'] = $outputFolder;
        $data['data']['fileName']           = $filePath;

        return $data;
    }
}
