<?php

namespace App\Validation;

use CodeIgniter\Files\File;
use Config\Mimes;

class CustomFileRules {
    /**
     * Verifies if the file's size in Kilobytes is no larger than the parameter.
     */
    public function max_size( $data,  $params) {
        if(!isset($data["size"])) return false;
        $accepted = $params;
        $size = $data["size"] / 1024;
        return $accepted > $size;
    }
    /**
     * Verifies that $name is the name of a valid uploaded file.
     */
    public function uploaded( $data,  $params) {
        return false;
    }
    /**
     * Uses the mime config file to determine if a file is considered an "image",
     * which for our purposes basically means that it's a raster image or svg.
     */
    public function is_image( $file,  $params) {
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
    public function mime_in( $file,  $params) {
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
    public function ext_in( $file,  $params) {
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
    public function max_dims(File $file, $params) {
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
    public function maxFiles($files, $params) {
        $maxFiles = $params;
        $numFiles = count($files);
        if($numFiles > $maxFiles) {
            return false;
        }
        return true;
    }
    public function minFiles($files, $params) {
        $minFiles = $params;
        $numFiles = count($files);
        if($numFiles < $minFiles) {
            return false;
        }
        return true;
    }
}