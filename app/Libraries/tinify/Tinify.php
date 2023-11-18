<?php

namespace App\Libraries\tinify;

use App\Utils\FileManager;
use CodeIgniter\Files\File;

class Tinify
{
    private static $allowedTypes = ['image/webp', 'image/png', 'image/jpeg'];
    
    public static function convertImages(array $keys)
    {
        if(!is_array($keys)) return false;
        
        // get all folders
        $references = array_map(function($fileFolder) {
            return FILES_UPLOAD_DIRECTORY . $fileFolder;
        }, $keys);

        // get all path of files and validates
        $passed = true;
        foreach ($references as &$filePath) {
            $filePath = FileManager::getFileFromFolder($filePath)[0] ?? "";
            if ( !is_file($filePath)) {
                $passed = false;
                break;
            }
            $file = new File($filePath);
            if ( mb_strpos($file->getMimeType(), 'image') !== 0) {
                $passed = false;
                break;
            }
        }
        unset($filePath);
        if(!$passed) return false;
        
        // Run the convertion on second plane
        $execFile = __DIR__ . "/tinifyConvertion.php";
        foreach ($references as $filePath) {
            $types = implode(',', self::$allowedTypes);
            $command = "php {$execFile} {$filePath} {$types}";
            self::execInBackground($command);
        }
        return $passed;
    }
    /**
     * Execute a command in second plane for Windows and Linux
     */
    private static function execInBackground($cmd) {
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B $cmd", "r"));
        } 
        else { 
            exec($cmd . " > /dev/null &");   
        }
    }
}
