<?php

namespace App\Libraries\tinify;

use App\Utils\FileManager;

class Tinify
{
    private static $allowedTypes = ['image/webp', 'image/png', 'image/jpeg'];
    private static $execFile     = __DIR__ . '\tinifyConvertion.php';

    /**
     * validate files and launch a command to make convertion
     *
     * @param array $keys the file keys to convert
     */
    public static function convertImages(array $keys)
    {
        // get the absolute path of files
        $files = array_map(static function ($fileFolder) {
            $fileOnUploadFolder = FILES_UPLOAD_DIRECTORY . $fileFolder;

            return FCPATH . trim(FileManager::getFileFromFolder($fileOnUploadFolder)[0] ?? '', './');
        }, $keys);

        foreach ($files as $filePath) {
            if (! is_file($filePath)) {
                return false;
            }
            if (mb_strpos(mime_content_type($filePath), 'image') !== 0) {
                return false;
            }
        }

        $execFile = self::$execFile;

        foreach ($files as $filePath) {
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
