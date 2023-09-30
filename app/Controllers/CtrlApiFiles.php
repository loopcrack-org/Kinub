<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;

class CtrlApiFiles extends BaseController
{

    private $folderTemp = "./files/tmp/";

    public function getFiles()
    {

        $fileName = $this->request->getGet()['load'];

        return $this->response->download($fileName, null, true);
    }

    public function save()
    {
        $images = $this->request->getPost('icon');

        $idFolder = md5(uniqid(rand(), true));

        foreach ($images as $value) {
            FileManager::changeFileDirectory($value, "./uploads/$idFolder/");
        }

        return redirect('/')->with('response', 'Imagenes guardadas con éxito');
    }

    public function index(): string
    {
        $data = glob("./files/img/**");

        return view('index', ['filesSaved' => $data]);
    }

    public function process()
    {
        $fileName = $this->request->getPost()['fileName'];
        $type = $this->request->getPost()['type'];
        $file = $this->request->getFiles()[$type] ?? null;

        $key = $this->folderTemp . $fileName;

        if ($file) {
            FileManager::moveClientFileToServer($file, $this->folderTemp);
        }

        return json_encode(['key' => $key]);
    }

    public function processChunk()
    {
        $fileName = $this->request->header('Upload-Name');
        $fileData = $this->request->getBody();
        $offset = $this->request->header('Upload-Offset')->getValue();

        $fileTmp = $this->folderTemp . $fileName->getValue();

        FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);
    }

    public function revert()
    {
        $filePath = $this->request->getBody();

        FileManager::deleteFile($filePath);
    }
}
