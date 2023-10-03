<?php

namespace App\Utils;

use CodeIgniter\Files\File;

class FileProcessor
{
    public static function convertImage(string $inputPath, string $destFolder): bool
    {
        try {
            $image = new File($inputPath);
            $imageName = explode("." . $image->getExtension(), $image->getBasename())[0];
            $inputPath = $image->getRealPath();

            FileManager::createFolder($destFolder);

            $imageService = \Config\Services::image();
            $imageService->withFile($inputPath)->convert(IMAGETYPE_WEBP)->save("$destFolder/$imageName.webp", 80);
            $imageService->withFile($inputPath)->convert(IMAGETYPE_PNG)->save("$destFolder/$imageName.png", 80);

            FileManager::deleteFile($inputPath);

            return true;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            exit;
            return false;
        }
    }
}
