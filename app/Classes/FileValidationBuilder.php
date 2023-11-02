<?php

namespace App\Classes;

use App\Interfaces\FileBuilder;
use App\Validation\FileValidation;

class FileValidationBuilder implements FileBuilder
{
    private $validationFile = [
        'rules' => '',
        'messages' => [],
    ];
    private $validationCollectionFiles = [
        'rules' => '',
        'messages' => [],
    ];

    public function build()
    {
        return new FileValidation($this);
    }

    public function acceptTypesFile(array $mimeTypes, String $labelExpectedTypes)
    {
        $types = implode(",", $mimeTypes);
        $this->validationFile['rules'] .= "mimeIn[$types]|";
        $this->validationFile["messages"]["mimeIn"] = $labelExpectedTypes;
        return $this;
    }
    public function maxSize(int $maxSize)
    {
        $this->validationFile["rules"] .= "maxSize[$maxSize]|";
        $this->validationFile["messages"]["maxSize"] = "El tamaño máximo permitido es de " . $maxSize / 1000 . "MB";
        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->validationCollectionFiles["rules"] .= "maxFiles[$maxFiles]|";
        $this->validationCollectionFiles["messages"]["maxFiles"] = $maxFiles > 1 ? "Se aceptan como máximo $maxFiles archivos" : "Se acepta como máximo 1 archivo";
        return $this;
    }
    public function minFiles(int $minFiles)
    {
        $this->validationCollectionFiles["rules"] .= "minFiles[$minFiles]|";
        $this->validationCollectionFiles["messages"]["minFiles"] = $minFiles > 1 ? "Se aceptan como mínimo $minFiles archivos" : "Se acepta como mínimo 1 archivo";
        return $this;
    }
    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->validationFile["rules"] .= "maxDims[$maxWidth, $maxHeight]|";
        $this->validationFile["messages"]["maxDims"] = "El archivo debe ser de $maxWidth por $maxHeight pixeles";
        return $this;
    }

    public function validationFile(): array
    {
        return $this->validationFile;
    }

    public function validationCollectionFiles(): array
    {
        return $this->validationCollectionFiles;
    }
}
