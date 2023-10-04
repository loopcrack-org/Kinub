<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;

class CtrlApiFiles extends BaseController
{

    private $folderTemp = "./files/tmp/";

    public function getFileFromServer()
    {

        try {
            $fileName = $this->request->getGet()['file'];
            return $this->response->setStatusCode(200)->download($fileName, null, true);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404, 'Archivo no encontrado en el servidor');
        }
    }

    public function processTempFile()
    {
        try {
            FileManager::createFolder($this->folderTemp);

            $type = $this->request->getPost()['type'];
            $file = $this->request->getFiles()[$type] ?? null;
            if ($file) {
                FileManager::moveClientFileToServer($file, $this->folderTemp);
            }

            $fileName = $this->request->getPost()['fileName'];
            $key = $this->folderTemp . $fileName;
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
            $filePath = $this->request->getBody();

            FileManager::deleteFile($filePath);

            $folder = dirname($filePath); 

            if (FileManager::isEmptyFolder($folder)) {
                FileManager::deleteEmptyFolder($folder); 
            }

            return $this->response->setStatusCode(201);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500);
        }
    }
}
