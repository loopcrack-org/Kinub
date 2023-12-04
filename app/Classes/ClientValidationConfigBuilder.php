<?php

namespace App\Classes;

use App\Interfaces\Filepond;
use App\Interfaces\ValidationConfigBuilder;
use Config\Mimes;

class ClientValidationConfigBuilder implements ValidationConfigBuilder, Filepond
{
    private array $filepondConfig = [
        'labelFileTypeNotAllowed'            => 'Archivo no válido',
        'acceptedFileTypes'                  => [],
        'fileValidateTypeLabelExpectedTypes' => 'Selecciona sólo archivos con la extensión',
        'labelIdle'                          => 'Arrastra y suelta tus archivos o <span class="filepond--label-action"> Selecciona </span>',
        'labelFileLoading'                   => 'Cargando',
        'labelFileProcessing'                => 'Procesando',
        'labelFileProcessingComplete'        => 'Carga completada',
        'labelTapToUndo'                     => 'toque para deshacer',
        'labelTapToCancel'                   => 'toque para cancelar',
        'labelFileWaitingForSize'            => 'Esperando tamaño',
        'allowMultiple'                      => false,
        'allowFileSizeValidation'            => true,
        'chunkUploads'                       => true,
        'chunkSize'                          => 1000000,
        'allowImagePreview'                  => false,
        'allowVideoPreview'                  => false,
        'allowAudioPreview'                  => false,
        'allowPdfPreview'                    => false,
    ];

    public function __construct(string $inputName)
    {
        $this->filepondConfig['name'] = $inputName;
    }

    public function build(): ClientValidationConfig
    {
        return new ClientValidationConfig($this);
    }

    public function previewImage()
    {
        $this->filepondConfig['allowImagePreview']       = true;
        $this->filepondConfig['imagePreviewHeight']      = 170;
        $this->filepondConfig['imageCropAspectRatio']    = '1:1';
        $this->filepondConfig['imageResizeTargetWidth']  = 200;
        $this->filepondConfig['imageResizeTargetHeight'] = 200;

        return $this;
    }

    public function previewVideo()
    {
        $this->filepondConfig['allowVideoPreview'] = true;
        $this->filepondConfig['allowAudioPreview'] = true;

        return $this;
    }

    public function previewPDF()
    {
        $this->filepondConfig['allowPdfPreview']  = true;
        $this->filepondConfig['pdfPreviewHeight'] = 200;

        return $this;
    }

    public function chunkSize(int $chunkSize)
    {
        $this->filepondConfig['chunkSize'] = $chunkSize;

        return $this;
    }

    public function allowMultipleFiles()
    {
        $this->filepondConfig['allowMultiple'] = true;

        return $this;
    }

    public function acceptTypesFile(array $fileExtensions)
    {
        foreach ($fileExtensions as $fileExtension) {
            $this->filepondConfig['acceptedFileTypes'][] = Mimes::guessTypeFromExtension($fileExtension);
            $this->filepondConfig['fileValidateTypeLabelExpectedTypes'] .= " .{$fileExtension}";
        }

        return $this;
    }

    public function isImage()
    {
        $this->previewImage();
        $this->acceptTypesFile(['png', 'jpg', 'jpeg']);

        return $this;
    }

    public function isPDF()
    {
        $this->previewPDF();
        $this->acceptTypesFile(['pdf']);

        return $this;
    }

    public function isVideo()
    {
        $this->previewVideo();
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
        $this->filepondConfig['maxFileSize']              = $maxSize . strtoupper($unit);
        $this->filepondConfig['labelMaxFileSizeExceeded'] = 'El archivo es demasiado grande.';
        $this->filepondConfig['labelMaxFileSize']         = 'El tamaño máximo permitido es de {filesize}';

        return $this;
    }

    public function minSize(int $minSize, string $unit)
    {
        $this->filepondConfig['minFileSize']              = $minSize . strtoupper($unit);
        $this->filepondConfig['labelMinFileSizeExceeded'] = 'El archivo es demasiado pequeño.';
        $this->filepondConfig['labelMinFileSize']         = 'El tamaño mínimo permitido es de {filesize}';

        return $this;
    }

    public function maxFiles(int $maxFiles)
    {
        $this->filepondConfig['maxFiles'] = $maxFiles;

        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->filepondConfig['minFiles'] = $minFiles;

        return $this;
    }

    public function maxDims(int $maxWidth, int $maxHeight)
    {
        $this->filepondConfig['imageValidateSizeMaxWidth']  = $maxWidth;
        $this->filepondConfig['imageValidateSizeMaxHeight'] = $maxHeight;

        return $this;
    }

    public function config()
    {
        return $this->filepondConfig;
    }
}
