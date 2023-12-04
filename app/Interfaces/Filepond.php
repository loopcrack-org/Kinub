<?php

namespace App\Interfaces;

interface Filepond
{
    public function chunkSize(int $chunkSize);

    public function allowMultipleFiles();
}
