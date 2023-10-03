<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;
use App\Utils\FileProcessor;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

class CtrlTestFiles extends BaseController
{
    public function index()
    {
        $img = glob("./uploads/**/image/**");
        $video = glob("./uploads/**/video/**");
        $pdf = glob("./uploads/**/pdf/**");
        $svg = glob("./uploads/**/svg/**");

        

        $data = ["img" => $img, "video" => $video, "pdf" => $pdf, "svg" => $svg]; 
        
        return view('admin/test/testFiles', ['filesSaved' => $data]); 
    }
    public function saveData()
    {

        $files = $this->request->getPost();
        $idFolder = md5(uniqid(rand(), true));

        // Save Images
        
        FileProcessor::convertImage($files["image"], "./uploads/$idFolder/image/");

        // Save Other files
        FileManager::changeFileDirectory($files['svg'], "./uploads/$idFolder/svg/");
        FileManager::changeFileDirectory($files['video'], "./uploads/$idFolder/video/");
        FileManager::changeFileDirectory($files['pdf'], "./uploads/$idFolder/pdf/");

        return redirect("admin/testFiles");
    }
}
