<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Utils\FileManager;
use CodeIgniter\Files\File;
use App\Exceptions\FileValidationException;
use Config\Services;
use Kint\Zval\Value;

class CtrlApiFiles extends BaseController
{
    private array $config = [];

    public function __construct(array $inputConfig)
    {
        foreach ($inputConfig as $value) {
            $this->config[$value->getInputName()] = $value;
        }
    }

    public function getFileFromServer()
    {
        try {
            $fileKey = $this->request->getGet()['file'];
            $fileModel = new FileModel();
            $fileRoute = $fileModel->select("fileRoute")->where("uuid", $fileKey)->first();

            return $this->response->setStatusCode(200)->download($fileRoute['fileRoute'], null, true);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404, "No se ha podido encontrar el archivo");
        }
    }

    public function restoreTemporalFile()
    {
        try {
            $key = $this->request->getGet()['file'];
            $folder = FILES_TEMP_DIRECTORY . $key;
            $file = FileManager::getFileFromFolder($folder)[0];

            return $this->response->setStatusCode(200)->download($file, null, true);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(404, "No se ha podido encontrar el archivo");
        }
    }

    public function processTemporalFile()
    {
        try {
            $inputName = $this->request->header("Input")->getValue();
            $file = $this->request->getFiles()[$inputName][0] ?? null;
            $key = FileManager::getFolderId();
            $folder = FILES_TEMP_DIRECTORY . $key;
            FileManager::createFolder($folder);

            if($file) {
                // validación con codeigniter
                $configValidation = $this->config[$inputName]->getFileValidation()->getValidation();
                $validation = Services::validation();
                $validation->setRules(
                    [
                        $inputName => $configValidation["rules"],
                    ],
                    [
                        $inputName => $configValidation["messages"],
                    ]
                );
                $validation->run([$inputName => $file]);
                if($validation->hasError($inputName)) {
                    $error = $validation->getError($inputName);
                    throw new FileValidationException($error);
                }
                // validación con la clase FileValidation
                // $this->config[$inputName]->getFileValidation()->validateFile($file);
                // FileManager::moveClientFileToServer($file, $folder);
            }

            return $this->response->setStatusCode(201)->setJSON(["key" => $key]);
        } catch (FileValidationException $th) {
            return $this->response->setStatusCode(500, json_encode($th->getMessage()));
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    public function processTemporalFileByChunks()
    {
        try {
            $key = $this->request->getGet("patch");
            $fileName = $this->request->header('Upload-Name')->getValue();
            $fileLength = $this->request->header('Upload-Length')->getValue();
            $fileData = $this->request->getBody();
            $offset = $this->request->header('Upload-Offset')->getValue();

            $folder = FILES_TEMP_DIRECTORY . $key;
            $fileTmp = "$folder/$fileName";

            $temporalFileLength = FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            if($temporalFileLength === $fileLength) {
                $file = new File($fileTmp);
                $inputName = $this->request->header("Input")->getValue();
                $this->config[$inputName]->getValidation()->validateFile($file);
            }

            return $this->response->setStatusCode(204);
        } catch (FileValidationException $th) {
            FileManager::deleteFolderWithContent($folder);
            return $this->response->setStatusCode(500)->setJSON(["error" => $th->getMessage()]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }
    public function deleteTemporalFile()
    {
        try {
            $key = $this->request->getBody();
            $folder = FILES_TEMP_DIRECTORY . $key;
            FileManager::deleteFolderWithContent($folder);
            return $this->response->setStatusCode(201);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }

    public function getConfig()
    {
        return $this->config;
    }
}
