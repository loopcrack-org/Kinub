<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Utils\FileManager;
use App\Validation\CustomFileValidation;
use CodeIgniter\Files\File;
use App\Exceptions\FileValidationException;

class CtrlApiFiles extends BaseController
{
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

            if ($file) {
                if(session()->has("fileValidation")) {
                    $validation = \Config\Services::validation();
                    $validation->setRules(
                        [$inputName => session()->get("fileValidation")["validationRules"][$inputName]],
                        [$inputName => session()->get("fileValidation")["messages"][$inputName]],
                    );
                    $validation->run([$inputName => $file]);
                    if($validation->hasError($inputName)) {
                        throw new FileValidationException($validation->getError($inputName));
                    }
                }
                FileManager::createFolder($folder);
                FileManager::moveClientFileToServer($file, $folder);
            } else {
                if(session()->has("fileValidation")) {
                    $file = [
                        "size" => $this->request->header("Upload-Length")->getValue(),
                    ];
                    $validation = new CustomFileValidation();
                    $validation->setRules(
                        session()->get("fileValidation")["customValidationRules"][$inputName]["beforeUpload"],
                        session()->get("fileValidation")["messages"][$inputName] ?? [],
                    );
                    $validation->run($file);
                }
                FileManager::createFolder($folder);
            }
            return $this->response->setStatusCode(201)->setJSON(["key" => $key]);
        } catch (FileValidationException $th) {
            return $this->response->setStatusCode(500, json_encode($th->getFileValidationError()));
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

            FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            if(session()->has("fileValidation")) {
                $configValidation = session()->get("fileValidation");
                $chunkSize = $configValidation["customValidationRules"]["chunkSize"];
                $uploaded = $offset + $chunkSize > $fileLength;

                if($uploaded) {
                    $inputName = $this->request->header("Input")->getValue();
                    $validation = new CustomFileValidation();
                    $validation->setRules(
                        $configValidation["customValidationRules"][$inputName]["afterUpload"],
                        $configValidation["messages"][$inputName],
                    );
                    $file = new File($fileTmp);
                    $validation->run($file);
                }
            }


            return $this->response->setStatusCode(204);
        } catch (FileValidationException $th) {
            FileManager::deleteFolderWithContent($folder);
            return $this->response->setStatusCode(500)->setJSON(["error" => $th->getFileValidationError()]);
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
}
