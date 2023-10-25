<?php

namespace App\Utils;

use CodeIgniter\Files\File;
use Exception;

class FileManager
{
    public static function getFolderId()
    {
        return md5(uniqid(rand(), true));
    }

    public static function getFileFromFolder(String $folderPath)
    {
        try {
            return glob("$folderPath/*");
        } catch (\Throwable $th) {
            throw new Exception("No se ha encontrado el archivo en la carpeta dada");
        }
    }

    public static function createFolder(String $path)
    {
        try {
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
        } catch (\Throwable $th) {
            throw new Exception("Ha ocurrido un error al crear la carpeta");
        }
    }


    public static function moveClientFileToServer(File $file, String $destPath)
    {
        try {
            $file->move($destPath);
        } catch (\Throwable $th) {
            throw new Exception("Ha ocurrido un error al guardar el archivo del cliente en el servidor");
        }
    }


    public static function changeDirectoryFolder(String $sourcePath, String $destPath)
    {
        try {
            rename($sourcePath, $destPath);
        } catch (\Throwable $th) {
            throw new Exception("La carpeta no existe o ha ocurrido un error al moverlo");
        }
    }

    public static function mergeChunckFiles(String $filePath, String $fileData, String $fileOffset)
    {
        try {
            if (!file_exists($filePath)) {
                file_put_contents($filePath, '');
            }

            $fileOpen = fopen($filePath, 'r+');
            fseek($fileOpen, $fileOffset);
            fwrite($fileOpen, $fileData);
            fclose($fileOpen);
        } catch (\Throwable $th) {
            throw new Exception("Ha ocurrido un error al procesar el archivo por partes");
        }
    }

    public static function deleteFolderWithContent(String $folderPath)
    {
        try {
            if (is_dir($folderPath)) {
                $files = glob($folderPath . '/*');
                foreach ($files as $file) {
                    is_dir($file) ? static::deleteFolderWithContent($file) : unlink($file);
                }
                rmdir($folderPath);
            }
        } catch (\Throwable $th) {
            throw new Exception("Ha ocurrido un error al eliminar la carpeta con su contenido");
        }
    }
}
