<?php

require_once dirname(__FILE__, 4) . '/vendor/autoload.php';

/**
 * get the file path from the executed command
 */
$filePath = $argv[1];
/**
 * get the types as a string from the executed command
 */
$types = explode(',', $argv[2]);

try {
    /**
     * file info
     */
    $pathInfo = pathinfo($filePath);
    $filename = $pathInfo['filename'];
    $dirname  = $pathInfo['dirname'];
    $ext      = $pathInfo['extension'];

    /**
     * get and set the Tinify key to use on library
     */
    $tinifyKey = getenv('tinifyKey');
    \Tinify\setKey($tinifyKey);

    /**
     * the reference to file on server
     */
    $source = Tinify\fromFile($filePath);

    /**
     * make the convertion to all formats specified
     */
    foreach ($types as $typeName) {
        $converted = $source->convert(['type' => [$typeName]]);
        $newExt    = $converted->result()->extension();
        $converted->toFile("{$dirname}/{$filename}.{$newExt}");
    }
} catch (\Throwable $th) {
    exit;
}
