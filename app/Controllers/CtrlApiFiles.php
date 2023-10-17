<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Utils\FileManager;

class CtrlApiFiles extends BaseController
{
    private $folderTemp = "./files/tmp/";
    private $folderUpload = "./uploads/";

    public function getFileFromServer()
    {

        try {
            $fileKey = $this->request->getGet()['file'];
            $fileModel = new FileModel();
            $fileRoute = $fileModel->select("fileRoute")->where("uuid", $fileKey)->first();

            return $this->response->setStatusCode(200)->download($fileRoute['fileRoute'], null, true);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404, $fileKey);
        }
    }

    public function processTempFile()
    {
        try {
            $key = FileManager::getFolderId();
            $folder = $this->folderTemp . $key;
            FileManager::createFolder($folder);

            $inputName = $this->request->getPost()['inputName'];
            $file = $this->request->getFiles()[$inputName][0] ?? null;
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
            $key = $this->request->getGet("patch");
            $fileName = $this->request->header('Upload-Name')->getValue();
            $fileData = $this->request->getBody();
            $offset = $this->request->header('Upload-Offset')->getValue();

            $fileTmp = "$this->folderTemp/$key/$fileName";

            FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            return $this->response->setStatusCode(204);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, 'Ha ocurrido un error mientras se cargaba el archivo');
        }
    }

    public function deleteTmpFile()
    {
        try {
            $key = $this->request->getBody();
            $folder = $this->folderTemp . $key;
            $file = scandir($folder)[2];
            FileManager::deleteFile("$folder/$file");

            if (FileManager::isEmptyFolder($folder)) {
                FileManager::deleteEmptyFolder($folder);
            }

            return $this->response->setStatusCode(201);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500);
        }
    }
    
    public function deleteFile() {
        try {
            $fileKey = $this->request->getBody();
            $fileFolder = $this->folderUpload . $fileKey . "/";
            $fileRoute = $fileFolder . scandir($fileFolder)[2];
            $fileModel = new FileModel();
            $fileModel->where("uuid", $fileKey)->delete();
            FileManager::deleteFile($fileRoute);
            if (FileManager::isEmptyFolder($fileFolder)) {
                FileManager::deleteEmptyFolder($fileFolder);
            }
            return $this->response->setStatusCode(201);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500);
        }
    }
}
