<?php

namespace App\Controllers;

use App\Utils\FileManager;
use Throwable;

class CtrlApiFiles extends BaseController
{
    /**
     * --------------------------------------------------------------------------
     * Get a file
     * --------------------------------------------------------------------------
     *
     * Here you can get a file saved on database and server
     *
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\ResponseInterface
     */
    public function getFileFromServer()
    {
        try {
            $fileKey = $this->request->getGet()['file'];
            // here you get the file route on database with the fileKey;
            $fileRoute = FILES_UPLOAD_DIRECTORY . '/8303bd6a-0b6b-43ea-ac23-31e02a64ba82/foto.png'; // example

            return $this->response->setStatusCode(200)->download($fileRoute['fileRoute'], null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(404, 'No se ha podido encontrar el archivo');
        }
    }

    /**
     * --------------------------------------------------------------------------
     * Get temporary file
     * --------------------------------------------------------------------------
     *
     * Filepond send a request with the file key to load a file on client side.
     *
     * @return \CodeIgniter\HTTP\DownloadResponse|\CodeIgniter\HTTP\ResponseInterface
     */
    public function restoreTemporalFile()
    {
        try {
            $key    = $this->request->getGet()['file'];
            $folder = FILES_TEMP_DIRECTORY . $key;
            $file   = FileManager::getFileFromFolder($folder)[0];

            return $this->response->setStatusCode(200)->download($file, null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(404, 'No se ha podido encontrar el archivo');
        }
    }

    /**
     * --------------------------------------------------------------------------
     * Process a file
     * --------------------------------------------------------------------------
     *
     * When filepond wants to process a file send a request. Here generates a folder with the key.
     * If the file exist (filepond send the file because the file is small) then it is saved on the
     * temporary folder on server and the server send the key to filepond.
     * If the file doesn´t exist (filepond not send the file because is big, and just request a key), then server just send the key
     * -- and begin a process for chunk files and it is going to be added later --.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function processTemporalFile()
    {
        try {
            $inputName = $this->request->header('Input')->getValue();
            $file      = $this->request->getFiles()[$inputName][0] ?? null;
            $key       = FileManager::getFolderId();
            $folder    = FILES_TEMP_DIRECTORY . $key;
            FileManager::createFolder($folder);

            if ($file) {
                FileManager::moveClientFileToServer($file, $folder);
            }

            return $this->response->setStatusCode(201)->setJSON(['key' => $key]);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(500, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    /**
     * --------------------------------------------------------------------------
     * Delete a file
     * --------------------------------------------------------------------------
     *
     * Filepond send a delete request to delete a temporary file
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function deleteTemporalFile()
    {
        try {
            $key    = $this->request->getBody();
            $folder = FILES_TEMP_DIRECTORY . $key;
            FileManager::deleteFolderWithContent($folder);

            return $this->response->setStatusCode(201);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(500, $th->getMessage());
        }
    }
}
