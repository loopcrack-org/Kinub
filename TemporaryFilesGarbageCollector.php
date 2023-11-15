<?php

function deleteFolderWithContent(String $folderPath)
{
    try {
        if (is_dir($folderPath)) {
            $files = glob($folderPath . '/*');
            foreach ($files as $file) {
                is_dir($file) ? deleteFolderWithContent($file) : unlink($file);
            }
            rmdir($folderPath);
        }
    } catch (\Throwable $th) {
        throw new Exception("Ha ocurrido un error al eliminar la carpeta con su contenido");
    }
}

function deleteOldTemporaryFiles()
{
    $timeNow = time();
    $limitTime = $timeNow - (12 * 60 * 60);
    $temporalFolders = glob("./public/files/tmp/*", GLOB_ONLYDIR);

    foreach ($temporalFolders as $temporalFolder) {
        $creationTime = filectime($temporalFolder);

        if ($creationTime <= $limitTime) {
            deleteFolderWithContent($temporalFolder);
        }
    }
}

deleteOldTemporaryFiles();