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
            'fileValidateTypeLabelExpectedTypes' => 'Selecciona sólo archivos con la extensión .jpg, .jpeg o .png',
            'labelFileTypeNotAllowed'            => 'Archivo no válido',
            'allowMultiple'                      => true,
            'maxFiles'                           => 3,
            'minFiles'                           => 2,
            'imagePreviewHeight'                 => 170,
            'imageCropAspectRatio'               => '1:1',
            'imageResizeTargetWidth'             => 200,
            'imageResizeTargetHeight'            => 200,
            'allowFileSizeValidation'            => true,
            'maxFileSize'                        => '5MB',
            'minFileSize'                        => '100KB',
            'labelMaxFileSizeExceeded'           => 'El archivo es demasiado grande.',
            'labelMaxFileSize'                   => 'El tamaño máximo permitido es de {filesize}',
            'labelMinFileSizeExceeded'           => 'El archivo es demasiado pequeño',
            'labelMinFileSize'                   => 'El tamaño mínimo permitido es de {filesize}',
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
