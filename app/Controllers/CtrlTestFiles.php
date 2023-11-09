<?php

namespace App\Controllers;

class CtrlTestFiles extends CtrlApiFiles
{
    /**
     * This variable container examples for filepond configuration
     * for image and viddeo files
     */
    protected $filepondConfig = [
        'baseUrl' => '/admin/testFiles',
        'image'   => [
            'name'                               => 'image',
            'acceptedFileTypes'                  => ['image/jpg', 'image/png', 'image/jpeg'],
            'fileValidateTypeLabelExpectedTypes' => 'Selecciona jpg, jpeg o png',
            'chunkUploads'                       => true,
            'labelFileTypeNotAllowed'            => 'Archivo no válido',
            'chunkSize'                          => 1000000,
            'allowMultiple'                      => true,
            'maxFiles'                           => 3,
            'minFiles'                           => 2,
            'imagePreviewHeight'                 => 170,
            'imageCropAspectRatio'               => '1:1',
            'imageResizeTargetWidth'             => 200,
            'imageResizeTargetHeight'            => 200,
            'allowFileSizeValidation'            => true,
            'labelMaxFileSizeExceeded'           => 'El archivo es demasiado grande.',
            'labelMaxFileSize'                   => 'El tamaño máximo permitido es de {filesize}',
        ],
    ];

    /**
     * View for create an entity that needs files
     *
     * This method return the view with the filepond configuration setted
     *
     * @return string
     */
    public function viewTestFilesCreate()
    {
        return view('admin/test/testFilesCreate', ['config' => $this->filepondConfig]);
    }
}
