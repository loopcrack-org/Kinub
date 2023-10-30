<?php

namespace App\Utils;

class FilepondManager
{
    public static function getSourceFiles(array $foldersFiles, string $sourceType): array
    {
        return array_map(function ($folderFile) use ($sourceType) {
            return [
                "source" => $folderFile,
                "options" => [
                    "type" => $sourceType
                ],
            ];
        }, $foldersFiles);
    }

    public static function getNewFilesInFilepond(array $filesFromPost, array $filesSaved): array
    {
        $auxFilesSaved =  array_map(function ($file) {return $file["uuid"];}, $filesSaved);
        return array_diff($filesFromPost, $auxFilesSaved) ?? [];
    }

    public static function getFilepondConfig(array $configFiles)
    {
        $configFilepond = [];

        foreach($configFiles as $value) {
            $configFilepond[] = $value->getFilepondConfig();
        }

        return $configFilepond;
    }
}
