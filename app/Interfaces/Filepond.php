<?php

namespace App\Interfaces;

interface Filepond
{
    public function previewImage();
    public function previewVideo();
    public function previewPDF();
    public function chunkSize(int $chunkSize);

    public function allowMultipleFiles();

}
