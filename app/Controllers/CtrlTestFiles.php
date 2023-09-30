<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Utils\FileManager;

class CtrlTestFiles extends BaseController
{
    public function index()
    {
        $data = glob("./uploads/**/**/**");
        
        return view('admin/test/testFiles', ['filesSaved' => $data]); 
    }
    public function saveData() {

        $files = $this->request->getPost(); 
        $idFolder = md5(uniqid(rand(), true));

        FileManager::changeFileDirectory($files['image'], "./uploads/$idFolder/image/");
        FileManager::changeFileDirectory($files['svg'], "./uploads/$idFolder/svg/");
        FileManager::changeFileDirectory($files['video'], "./uploads/$idFolder/video/");
        FileManager::changeFileDirectory($files['pdf'], "./uploads/$idFolder/pdf/");    
    
        return redirect("admin/testFiles");
    }
}
