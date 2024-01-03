<?php

namespace App\Interfaces;

interface ValidationConfigBuilder
{
    public function build();

    public function acceptTypesFile(array $fileExtensions);

    public function isImage();

    public function isPDF();

    public function isSVG();

    public function isVideo();

    public function maxSize(int $maxSize, string $unit);

    public function minSize(int $minSize, string $unit);

    public function maxFiles(int $maxFiles);

    public function minFiles(int $minFiles);

    public function maxDims(int $maxWidth, int $maxHeight);
}
