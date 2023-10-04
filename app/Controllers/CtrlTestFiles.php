<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager; 
use App\Utils\FileProcessor;

class CtrlTestFiles extends BaseController
{

    public function index()
    {
        $img = glob("./uploads/**/*.png");
        $video = glob("./uploads/**/*.mp4");
        $pdf = glob("./uploads/**/*.pdf");
        $svg = glob("./uploads/**/*.svg");

        $data = ["img" => $img, "video" => $video, "pdf" => $pdf, "svg" => $svg]; 
        
        return view('admin/test/testFiles', ['filesSaved' => $data]); 
    }

    public function saveData() { 
        $files = $this->request->getPost();
        $idFolder = md5(uniqid(rand(), true));
        $outputFolder = "./uploads/$idFolder/"; 
        FileManager::createFolder($outputFolder); 


        // Save Images
        if ($files['image']) {
            FileManager::changeFileDirectory($files['image'], $outputFolder);
        } 
        // Save Other files
        if ($files['svg']) {
            FileManager::changeFileDirectory($files['svg'], $outputFolder);
        }

        if ($files['video']) {
            FileManager::changeFileDirectory($files['video'], $outputFolder);
        } 

        if ($files['pdf']) {
            FileManager::changeFileDirectory($files['pdf'], $outputFolder);
        }

        return redirect("admin/testFiles");
    }
}
