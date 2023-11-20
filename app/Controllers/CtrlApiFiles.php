<?php

namespace App\Controllers;

use App\Exceptions\FileValidationException;
use App\Utils\FileManager;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Throwable;

class CtrlApiFiles extends BaseController
{
    protected $validationConfig;

    /**
     * Get a file
     *
     * Here you can get a file saved on database and server
     *
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\ResponseInterface
     *
     * @throws Throwable if the $fileRoute doesn´t exist on server
     */
    public function getFileFromServer()
    {
        try {
            $fileKey = $this->request->getGet()['file'];
            // here you get the file route on database with the fileKey;
            $fileRoute = FILES_UPLOAD_DIRECTORY . "/{$fileKey}/foto.png"; // example

            return $this->response->setStatusCode(Response::HTTP_OK)->download($fileRoute['fileRoute'], null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND, 'No se ha podido encontrar el archivo');
        }
    }

    /**
     * Get temporary file
     *
     * Filepond send a request with the file key to load a file on client side.
     *
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\ResponseInterface
     *
     * @throws Throwable if the $folder doesn´t exist on server
     */
    public function restoreTemporalFile()
    {
        try {
            $key    = $this->request->getGet()['file'];
            $folder = FILES_TEMP_DIRECTORY . $key;
            $file   = FileManager::getFileFromFolder($folder)[0];

            return $this->response->setStatusCode(Response::HTTP_OK)->download($file, null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND, 'No se ha podido encontrar el archivo');
        }
    }

    /**
     * Process a file
     *
     * When filepond wants to process a file send a request. Here generates a folder with the key.
     * If the file exist (filepond send the file because the file is small) then it is saved on the
     * temporary folder on server and the server send the key to filepond.
     * If the file doesn´t exist (filepond not send the file because is big, and just request a key), then server just send the key
     * -- and begin a process for chunk files and it is going to be added later --.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     *
     * @throws Throwable If $inputName doesn´t exist
     */
    public function processTemporalFile()
    {
        try {
            $inputName = $this->request->header('Input')->getValue();
            $file      = $this->request->getFiles()[$inputName][0] ?? null;
            $key       = FileManager::generateFolderId();
            $folder    = FILES_TEMP_DIRECTORY . $key;
            FileManager::createFolder($folder);

            if ($file) {
                $configValidation = $this->validationConfig[$inputName];
                $validation       = Services::validation();
                $validation->setRules(
                    [
                        $inputName => $configValidation['rules'],
                    ],
                    [
                        $inputName => $configValidation['messages'],
                    ]
                );
                if (! $validation->run([$inputName => $file])) {
                    $error = $validation->getError($inputName);

                    throw new FileValidationException($error);
                }
                FileManager::moveClientFileToServer($file, $folder);
            }

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON(['key' => $key]);
        } catch (FileValidationException $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode($th->getMessage()));
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    public function processTemporalFileByChunks()
    {
        try {
            $key        = $this->request->getGet('patch');
            $fileName   = $this->request->header('Upload-Name')->getValue();
            $fileLength = $this->request->header('Upload-Length')->getValue();
            $fileData   = $this->request->getBody();
            $offset     = $this->request->header('Upload-Offset')->getValue();

            $folder  = FILES_TEMP_DIRECTORY . $key;
            $fileTmp = "{$folder}/{$fileName}";

            $temporalFileLength = FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            if ((string) $temporalFileLength === $fileLength) {
                $file             = new File($fileTmp);
                $inputName        = $this->request->header('Input')->getValue();
                $configValidation = $this->validationConfig[$inputName];
                $validation       = Services::validation();
                $validation->setRules(
                    [
                        $inputName => $configValidation['rules'],
                    ],
                    [
                        $inputName => $configValidation['messages'],
                    ]
                );
                if (! $validation->run([$inputName => $file])) {
                    $error = $validation->getError($inputName);

                    throw new FileValidationException($error);
                }
            }

            return $this->response->setStatusCode(Response::HTTP_OK);
        } catch (FileValidationException $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode($th->getMessage()));
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    /**
     * Delete a file
     *
     * Filepond send a delete request to delete a temporary file
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     *
     * @throws Throwable if the $folder doesn´t exist on server
     */
    public function deleteTemporalFile()
    {
        try {
            $key    = $this->request->getBody();
            $folder = FILES_TEMP_DIRECTORY . $key;
            FileManager::deleteFolderWithContent($folder);

            return $this->response->setStatusCode(Response::HTTP_OK);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
