<?php

namespace App\Controllers;

class CtrlTestFiles extends CtrlApiFiles
{
    /**
     * This variable container examples for filepond configuration
     * for image
     */
    protected $filepondConfig = [
        'baseUrl' => '/admin/testFiles',
        'image'   => [
            'name' => 'image',
            // 'acceptedFileTypes'                  => ['image/jpg', 'image/png', 'image/jpeg'],
            'fileValidateTypeLabelExpectedTypes' => 'Selecciona sólo archivos con la extensión .jpg, .jpeg o .png',
            'labelFileTypeNotAllowed'            => 'Archivo no válido',
            'chunkUploads'                       => true,
            'chunkSize'                          => 100000,
            'allowMultiple'                      => true,
            // 'maxFiles'                           => 3,
            // 'minFiles'                           => 2,
            'imagePreviewHeight'      => 170,
            'imageCropAspectRatio'    => '1:1',
            'imageResizeTargetWidth'  => 200,
            'imageResizeTargetHeight' => 200,
            'allowFileSizeValidation' => true,
            // 'maxFileSize'                        => '5MB',
            // 'minFileSize'                        => '100KB',
            'labelIdle'                   => 'Arrastra y suelta tus archivos o <span class="filepond--label-action"> Selecciona </span>',
            'labelFileLoading'            => 'Cargando',
            'labelFileProcessing'         => 'Procesando',
            'labelFileProcessingComplete' => 'Carga completada',
            'labelTapToUndo'              => 'toque para deshacer',
            'labelTapToCancel'            => 'toque para cancelar',
            'labelFileWaitingForSize'     => 'Esperando tamaño',
            'labelMaxFileSizeExceeded'    => 'El archivo es demasiado grande.',
            'labelMaxFileSize'            => 'El tamaño máximo permitido es de {filesize}',
            'labelMinFileSizeExceeded'    => 'El archivo es demasiado pequeño',
            'labelMinFileSize'            => 'El tamaño mínimo permitido es de {filesize}',
        ],
    ];

    /**
     * configuration for validation from server through the api
     */
    protected $validationConfig = [
        'image' => [
            'rules'    => 'maxSize[200,kb]|minSize[1,b]|mimeIn[image/png,image/jpeg,image/jpg]|maxDims[3000,3000]',
            'messages' => [
                'maxSize' => 'La imagen debe ser menor a 100 kilobytes',
                'minSize' => 'La imagen debe ser mayor a 1 kilobytes',
                'maxDims' => 'Las dimensiones máximas de imagen son de 100px por 100px',
                'mimeIn'  => 'Tipo de archivo inválido, selecciona image/png,image/jpeg,image/jpg',
                'extIn'   => 'Extensión de archivo inválido, selecciona .png, .jpeg o .jpg',
            ],
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
        return view('admin/test/testFilesCreate', ['filepondConfig' => $this->filepondConfig]);
    }
}
