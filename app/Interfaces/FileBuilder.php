<?php

namespace App\Interfaces;

interface FileBuilder
{
    public function build();
    public function acceptTypesFile(array $mimeTypes, String $labelExpectedTypes);
    public function maxSize(int $maxSize);
    public function maxFiles(int $maxFiles);
    public function minFiles(int $minFiles);
    public function maxDims(int $maxWidth, int $maxHeight);
}
