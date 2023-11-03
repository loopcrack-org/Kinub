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

    public static function getFilesInFilepond(array $filesFromPost, array $filesSaved): array
    {
        $newFiles = array_diff($filesFromPost, $filesSaved) ?? [];
        return array_merge([
            self::getSourceFiles($filesSaved, "local"),
            self::getSourceFiles($newFiles, "limbo"),
        ]);
    }

    public static function getFilepondConfig(array $configFiles)
    {
        $configFilepond = [];

        foreach($configFiles as $inputName => $value) {
            $configFilepond[$inputName] = $value->getFilepondConfig()->getConfig();
        }

        return $configFilepond;
    }
}
