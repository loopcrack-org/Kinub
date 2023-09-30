<?php
namespace App\Utils;

use CodeIgniter\Files\File;

class FileManager{

    public static function createFolder(String $path){
        if (!is_dir($path)) {
            mkdir($path, 0777, true); 
        }
    }

    public static function moveClientFileToServer(File $file, String $destPath) {
        $file->move($destPath); 
    }


    public static function changeFileDirectory(String $sourcePath, String $destPath){
        if (file_exists($sourcePath)) {
            static::createFolder($destPath); 
            $file = new File($sourcePath, true); 
            $file->move($destPath);
        }
    }

    public static function mergeChunckFiles(String $filePath, String $fileData, String $fileOffset){
        if (!file_exists($filePath)) {
            file_put_contents($filePath, '');    
        }

        $fileOpen = fopen($filePath, 'r+');
        fseek($fileOpen, $fileOffset);
        fwrite($fileOpen, $fileData);
        fclose($fileOpen);
    }

    public static function deleteFile(String $filePath) {
        if (file_exists($filePath)){
            unlink($filePath); 
        }
    }

    public static function deleteFolder(String $folderPath){
        if (is_dir($folderPath)) {
            $files = glob($folderPath . '/*');
            foreach ($files as $file) {
                is_dir($file) ? static::deleteFolder($file) : unlink($file);
            }    
            rmdir($folderPath);
        }
    }
}