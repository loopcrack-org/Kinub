<?php

namespace App\Classes;

use App\Interfaces\ValidationConfigBuilder;
use Config\Mimes;

class ServerValidationConfigBuilder implements ValidationConfigBuilder
{
    private $fileValidationRules = [
        'rules'    => '',
        'messages' => [
            'mimeIn' => 'Selecciona sólo archivos con extensión',
        ],
    ];
    private $collectionFileValidationRules = [
        'rules'    => '',
        'messages' => [],
    ];

    public function build()
    {
        return new ServerValidationConfig($this);
    }

    public function acceptTypesFile(array $fileExtensions)
    {
        $mimeTypes = '';

        foreach ($fileExtensions as $fileExtension) {
            $mimeTypes                                       .= Mimes::guessTypeFromExtension($fileExtension) . ',';
            $this->fileValidationRules['messages']['mimeIn'] .= " .{$fileExtension}";
        }

        if (preg_match('/mimeIn\[(.*?)\]/', $this->fileValidationRules['rules'], $matches)) {
            $mimeTypes                          = "{$matches[1]}," . substr($mimeTypes, 0, -1);
            $this->fileValidationRules['rules'] = preg_replace('/mimeIn\[(.*?)\]/', "mimeIn[{$mimeTypes}]", $this->fileValidationRules['rules']);
        } else {
            $this->fileValidationRules['rules'] .= "mimeIn[{$mimeTypes}]|";
        }

        return $this;
    }

    public function isImage()
    {
        $this->acceptTypesFile(['png', 'jpg', 'jpeg']);

        return $this;
    }

    public function isPDF()
    {
        $this->acceptTypesFile(['pdf']);

        return $this;
    }

    public function isVideo()
    {
        $this->acceptTypesFile(['mp4']);

        return $this;
    }

    public function isSVG()
    {
        $this->acceptTypesFile(['svg']);

        return $this;
    }

    public function maxSize(int $maxSize, string $unit)
    {
        $this->fileValidationRules['rules'] .= "maxSize[{$maxSize},{$unit}]|";
        $this->fileValidationRules['messages']['maxSize'] = "El tamaño máximo permitido es de {$maxSize}" . strtoupper($unit);

        return $this;
    }

    public function minSize(int $minSize, string $unit)
    {
        $this->fileValidationRules['rules'] .= "minSize[{$minSize},{$unit}]|";
        $this->fileValidationRules['messages']['minSize'] = "El tamaño mínimo permitido es de {$minSize}" . strtoupper($unit);

        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->collectionFileValidationRules['rules'] .= "maxFiles[{$maxFiles}]|";
        $this->collectionFileValidationRules['messages']['maxFiles'] = $maxFiles > 1 ? "Se aceptan como máximo {$maxFiles} archivos" : 'Se acepta como máximo 1 archivo';

        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->collectionFileValidationRules['rules'] .= "minFiles[{$minFiles}]|";
        $this->collectionFileValidationRules['messages']['minFiles'] = $minFiles > 1 ? "Se aceptan como mínimo {$minFiles} archivos" : 'Se acepta como mínimo 1 archivo';

        return $this;
    }

    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->fileValidationRules['rules'] .= "maxDims[{$maxWidth},{$maxHeight}]|";
        $this->fileValidationRules['messages']['maxDims'] = "El archivo debe ser de {$maxWidth} por {$maxHeight} pixeles";

        return $this;
    }

    public function fileValidationRules(): array
    {
        return $this->fileValidationRules;
    }

    public function collectionFileValidationRules(): array
    {
        return $this->collectionFileValidationRules;
    }
}
