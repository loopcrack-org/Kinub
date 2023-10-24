<?php

namespace App\Utils;

class FilePondManager
{
    public static function getSourceFiles(array $foldersFiles, string $sourceType): array
    {
        $sourceFiles = [];
        foreach ($foldersFiles as $folderFile) {
            $localSourceFiles[] = [
                "source" => $folderFile,
                "options" => [
                    "type" => $sourceType
                ],
            ];

        }
        return $sourceFiles;
    }
}