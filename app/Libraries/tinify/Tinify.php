<?php

namespace App\Libraries\tinify;

use App\Utils\FileManager;
use CodeIgniter\Files\File;

class Tinify
{
    private static $allowedTypes = ['image/webp', 'image/png', 'image/jpeg'];

    /**
     * validate the image to make the convertion and launch the commando to convertion on file tinifyConvertion.php
     *
     * @param array $keys the file keys to convert
     */
    public static function convertImages(array $keys)
    {
        if (! is_array($keys)) {
            return false;
        }
        // references to folders and files
        $references = array_map(static fn ($fileFolder) => FILES_UPLOAD_DIRECTORY . $fileFolder, $keys);

        foreach ($references as &$filePath) {
            $path = trim(FileManager::getFileFromFolder($filePath)[0] ?? '', './');
            if (empty($path)) {
                return false;
            }
            // The absolute path of file
            $filePath = FCPATH . $path;
            if (! is_file($filePath)) {
                return false;
            }
            $file = new File($filePath);
            if (mb_strpos($file->getMimeType(), 'image') !== 0) {
                return false;
            }
        }
        unset($filePath);

        // Run the convertion on second plane
        $execFile = __DIR__ . '\tinifyConvertion.php';

        foreach ($references as $filePath) {
            $types   = implode(',', self::$allowedTypes);
            $command = "php \"{$execFile}\" \"{$filePath}\" \"{$types}\"";
            self::execInBackground($command);
        }

        return true;
    }

    /**
     * Execute a command in second plane for Windows and Linux
     *
     * @param mixed $cmd the commando to run
     */
    private static function execInBackground($cmd)
    {
        // for windows
        if (substr(php_uname(), 0, 7) === 'Windows') {
            pclose(popen("start /B {$cmd}", 'r'));
        }
        // for linux
        else {
            exec($cmd . ' > /dev/null &');
        }
    }
}
