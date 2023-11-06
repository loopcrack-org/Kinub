<?php

namespace App\Libraries\fileValidation;

use CodeIgniter\Files\File;
use Config\Mimes;

class FileRules
{
    /**
     * Verifies if the file's size in Kilobytes is no larger than the parameter.
     */
    public function maxSize($file, $params)
    {
        if($file === null) {
            return false;
        }

        $size = $file->getSizeByUnit('kb');

        $accepted = $params;

        return $accepted > $size;
    }
    /**
     * Verifies that $name is the name of a valid uploaded file.
     */
    public function uploaded($data, $params)
    {
        return false;
    }
    /**
     * Uses the mime config file to determine if a file is considered an "image",
     * which for our purposes basically means that it's a raster image or svg.
     */
    public function isImage($file, $params)
    {
        $params = explode(',', $params);

        if ($file === null) {
            return false;
        }

        // We know that our mimes list always has the first mime
        // start with `image` even when then are multiple accepted types.
        $type = Mimes::guessTypeFromExtension($file->getExtension()) ?? '';

        if (mb_strpos($type, 'image') !== 0) {
            return false;
        }

        return true;
    }
    /**
     * Checks to see if an uploaded file's mime type matches one in the parameter.
     */
    public function mimeIn($file, $params)
    {
        $params = explode(',', $params);

        if ($file === null) {
            return false;
        }

        if (! in_array($file->getMimeType(), $params, true)) {
            return false;
        }

        return true;
    }
    /**
     * Checks to see if an uploaded file's extension matches one in the parameter.
     */
    public function extIn($file, $params)
    {
        $params = explode(',', $params);

        if ($file === null) {
            return false;
        }

        if (! in_array($file->guessExtension(), $params, true)) {
            return false;
        }

        return true;
    }
    /**
     * Checks an uploaded file to verify that the dimensions are within
     * a specified allowable dimension.
     */
    public function maxDims(File $file, $params)
    {
        $params = explode(',', $params);

        if ($file === null) {
            return false;
        }

        // Get Parameter sizes
        $allowedWidth  = $params[0] ?? 0;
        $allowedHeight = $params[1] ?? 0;

        // Get uploaded image size
        $info       = getimagesize($file->getRealPath());
        $fileWidth  = $info[0];
        $fileHeight = $info[1];

        if ($fileWidth > $allowedWidth || $fileHeight > $allowedHeight) {
            return false;
        }

        return true;
    }
    public function maxFiles($files, $params)
    {
        $maxFiles = $params;
        $numFiles = count($files);
        if($numFiles > $maxFiles) {
            return false;
        }
        return true;
    }
    public function minFiles($files, $params)
    {
        $minFiles = $params;
        $numFiles = count($files);
        if($numFiles < $minFiles) {
            return false;
        }
        return true;
    }
}
