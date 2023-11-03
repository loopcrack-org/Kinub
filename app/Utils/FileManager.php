<?php

namespace App\Utils;

use CodeIgniter\Files\File;
use Exception;
use Throwable;

class FileManager
{
    public static function getFolderId()
    {
        return md5(uniqid(mt_rand(), true));
    }

    public static function getFileFromFolder(string $folderPath)
    {
        try {
            return glob("{$folderPath}/*");
        } catch (Throwable $th) {
            throw new Exception('No se ha encontrado el archivo en la carpeta dada');
        }
    }

    public static function createFolder(string $path)
    {
        try {
            if (! is_dir($path)) {
                mkdir($path, 0777, true);
            }
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al crear la carpeta');
        }
    }

    public static function moveClientFileToServer(File $file, string $destPath)
    {
        try {
            $file->move($destPath);
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al guardar el archivo del cliente en el servidor');
        }
    }

    public static function changeDirectoryFolder(string $sourcePath, string $destPath)
    {
        try {
            rename($sourcePath, $destPath);
        } catch (Throwable $th) {
            throw new Exception('La carpeta no existe o ha ocurrido un error al moverlo');
        }
    }

    public static function changeDirectoryCollectionFolder(array $keys)
    {
        try {
            foreach ($keys as $key) {
                $outputFolder = FILES_UPLOAD_DIRECTORY . $key;
                $sourceFolder = FILES_TEMP_DIRECTORY . $key;
                rename($sourceFolder, $outputFolder);
            }
        } catch (Throwable $th) {
            throw new Exception('Error al mover los archivos');
        }
    }

    public static function deleteFolderWithContent(string $folderPath)
    {
        try {
            if (is_dir($folderPath)) {
                $files = glob($folderPath . '/*');

                foreach ($files as $file) {
                    is_dir($file) ? static::deleteFolderWithContent($file) : unlink($file);
                }
                rmdir($folderPath);
            }
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al eliminar la carpeta con su contenido');
        }
    }
}
