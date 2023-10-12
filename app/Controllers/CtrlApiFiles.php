<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;
use Exception;

class CtrlApiFiles extends BaseController
{
    private $folderTemp = "./files/tmp/";

    public function getFileFromServer()
    {

        try {
            $fileName = $this->request->getGet()['file'];
            return $this->response->setStatusCode(200)->download($fileName, null, true);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404, $fileName);
        }
    }

    public function processTempFile()
    {
        try {
            $key = md5(uniqid(rand(), true));
            $folder = $this->folderTemp . $key;
            FileManager::createFolder($folder);

            $inputName = $this->request->getPost()['inputName'];
            $file = $this->request->getFiles()[$inputName][0] ?? new Exception("input no encontrado");
            if ($file) {
                FileManager::moveClientFileToServer($file, $folder);
            }

            return $this->response->setStatusCode(201)->setJSON(["key" => $key]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, 'Ha ocurrido un error mientras se cargaba el archivo');
        }
    }

    public function processTempFileChunk()
    {
        try {
            //code...
            $fileName = $this->request->header('Upload-Name')->getValue();
            $fileData = $this->request->getBody();
            $offset = $this->request->header('Upload-Offset')->getValue();

            $fileTmp = $this->folderTemp . $fileName;

            FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            return $this->response->setStatusCode(204);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, 'Ha ocurrido un error mientras se cargaba el archivo');
        }
    }

    public function deleteFile()
    {
        try {
            $key = $this->request->getBody();
            $folder = $this->folderTemp . $key;
            $file = glob("$folder/*.*")[0];
            FileManager::deleteFile($file);

            if (FileManager::isEmptyFolder($folder)) {
                FileManager::deleteEmptyFolder($folder);
            }

            return $this->response->setStatusCode(201);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500);
        }
    }
}
