<?php

namespace App\Utils;

use Throwable;

class FileUtils
{
    /**
     * convert the key files into an array to save on database
     *
     * @return array
     */
    public static function getFileEntities(array $keyFiles)
    {
        try {
            return array_map(static function ($key) {
                $outputFolder = FILES_UPLOAD_DIRECTORY . $key;
                $sourceFolder = FILES_TEMP_DIRECTORY . $key;
                $filePath     = scandir($sourceFolder)[2];

                return [
                    'fileRoute'          => "{$outputFolder}/{$filePath}",
                    'uuid'               => $key,
                    'fileDirectoryRoute' => $outputFolder,
                    'fileName'           => $filePath,
                ];
            }, $keyFiles);
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
