<?php

require_once(dirname(__FILE__, 4) . "/vendor/autoload.php");

$filePath = $argv[1];
$types = explode(',', $argv[2]);

if(!is_file($filePath)) exit;
$pathInfo = pathinfo($filePath);

/**
 * file info
 */
$filename = $pathInfo["filename"];
$dirname = $pathInfo["dirname"];
$ext = $pathInfo["extension"];

$tinyKeys = getenv('tinifyKey');
\Tinify\setKey($tinyKeys);

$source = Tinify\fromFile($filePath);
foreach ($types as $typeName) {
    $converted            = $source->convert(['type' => [$typeName]]);
    $newExt            = $converted->result()->extension();
    $converted->toFile("{$dirname}/{$filename}.{$newExt}");
}