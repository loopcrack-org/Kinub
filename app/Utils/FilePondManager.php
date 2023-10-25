<?php

namespace App\Utils;

class FilepondManager
{
    public static function getSourceFiles(array $foldersFiles, string $sourceType): array
    {
        $sourceFiles = [];
        foreach ($foldersFiles as $folderFile) {
            $sourceFiles[] = [
                "source" => $folderFile['uuid'],
                "options" => [
                    "type" => $sourceType
                ],
            ];
        }
        return $sourceFiles;
    }

    public static function getNewFilesInFilepond(array $filesFromPost, array $filesSaved): array
    {
        $auxFilesSaved =  array_map(function ($file) {return $file["uuid"];}, $filesSaved);
        return array_diff($filesFromPost, $auxFilesSaved) ?? [];
    }
}
