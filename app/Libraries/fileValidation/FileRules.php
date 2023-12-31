<?php

namespace App\Libraries\fileValidation;

use CodeIgniter\Files\File;

class FileRules
{
    /**
     * Verifies if the file's size in given unit is no larger than the parameter.
     *
     * @param File  $file   the instance of file
     * @param mixed $params params passed through validation rules
     */
    public function maxSize(File $file, $params)
    {
        if ($file === null) {
            return false;
        }

        $params   = explode(',', $params);
        $size     = (float) str_replace(',', '', $file->getSizeByUnit(strtolower($params[1])));
        $accepted = (float) $params[0];

        return $accepted > $size;
    }

    /**
     * Verifies if the file's size in given unit is larger than the parameter.
     *
     * @param File  $file   the instance of file
     * @param mixed $params params passed through validation rules
     */
    public function minSize(File $file, $params)
    {
        if ($file === null) {
            return false;
        }

        $params   = explode(',', $params);
        $size     = (float) str_replace(',', '', $file->getSizeByUnit(strtolower($params[1])));
        $accepted = (float) $params[0];

        return $accepted < $size;
    }

    /**
     * Checks to see if an uploaded file's mime type matches one in the parameter.
     *
     * @param File  $file   the instance of file
     * @param mixed $params params passed through validation rules
     */
    public function mimeIn(File $file, $params)
    {
        $params = explode(',', $params);

        if ($file === null) {
            return false;
        }

        return ! (! in_array($file->getMimeType(), $params, true));
    }

    /**
     * Checks an uploaded file to verify that the dimensions are within
     * a specified allowable dimension.
     *
     * @param File  $file   the instance of file
     * @param mixed $params params passed through validation rules
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

        return ! ($fileWidth > $allowedWidth || $fileHeight > $allowedHeight);
    }

    /**
     * Check if the array has the maximum items according to the max number passed on param
     *
     * @param array $files  the files to validate
     * @param mixed $params params passed through validation rules
     */
    public function maxFiles(array $files, $params)
    {
        $maxFiles = $params;
        $numFiles = count($files);

        return ! ($numFiles > $maxFiles);
    }

    /**
     * Check if the array has the minimum items according to the min number passed on param
     *
     * @param array $files  the files to validate
     * @param mixed $params params passed through validation rules
     */
    public function minFiles(array $files, $params)
    {
        $minFiles = $params;
        $numFiles = count($files);

        return ! ($numFiles < $minFiles || $files[0] === '');
    }
}
