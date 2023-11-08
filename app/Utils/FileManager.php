<?php

namespace App\Utils;

use CodeIgniter\Files\File;
use Exception;
use Throwable;

/**
 * Class FileManager for file and folder management.
 */
class FileManager
{
    /**
     * Generate a unique key for a folder.
     *
     * @return string
     */
    public static function getFolderId()
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * Get files in a folder.
     *
     * @param string $folderPath Folder path.
     *
     * @return array List of files in the folder.
     *
     * @throws Exception If the folder is not found.
     */
    public static function getFileFromFolder(string $folderPath)
    {
        try {
            return glob("{$folderPath}/*");
        } catch (Throwable $th) {
            throw new Exception('No se ha encontrado el archivo en la carpeta dada');
        }
    }

    /**
     * Create a folder at the specified path.
     *
     * @param string $path Path of the folder to create.
     *
     * @throws Exception If an error occurs while creating the folder.
     */
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

    /**
     * Move a file from the client to the server.
     *
     * @param File   $file     File to move.
     * @param string $destPath Destination path on the server.
     *
     * @throws Exception If an error occurs while moving the file.
     */
    public static function moveClientFileToServer(File $file, string $destPath)
    {
        try {
            $file->move($destPath);
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al guardar el archivo del cliente en el servidor');
        }
    }

    /**
     * Change the location of a folder.
     *
     * @param string $sourcePath Source path.
     * @param string $destPath   Destination path.
     *
     * @throws Exception If the folder does not exist or if an error occurs while moving it.
     */
    public static function changeDirectoryFolder(string $sourcePath, string $destPath)
    {
        try {
            rename($sourcePath, $destPath);
        } catch (Throwable $th) {
            throw new Exception('La carpeta no existe o ha ocurrido un error al moverla');
        }
    }

    /**
     * Change the location of a collection of folders.
     *
     * @param array $keys Array of folder keys.
     *
     * @throws Exception If an error occurs while moving the files.
     */
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

    /**
     * Delete a folder and its content.
     *
     * @param string $folderPath Path of the folder to delete.
     *
     * @throws Exception If an error occurs while deleting the folder and its content.
     */
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
