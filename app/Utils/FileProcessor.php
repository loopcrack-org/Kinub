<?php
namespace App\Utils;

use Intervention\Image\ImageManagerStatic as Image;

class FileProcessor {
    public static function convertImage(string $inputPath, string $destPath): bool {
        try {
            Image::make($inputPath)->encode("webp", 80)->save("$destPath.webp");
            Image::make($inputPath)->encode("png", 80)->save("$destPath.png");
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}