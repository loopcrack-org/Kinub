<?php

namespace App\Controllers;

use App\Classes\ClientValidationConfig;

class CtrlTestFiles extends CtrlApiFiles
{
    /**
     * This variable containes the filepond configuration
     */
    protected $filepondConfig;

    /**
     * configuration for validation from server through the api
     */
    protected $validationConfig = [
        'image' => [
            'rules'    => 'maxSize[200,kb]|mimeIn[image/png,image/jpeg,image/jpg]|maxDims[3000,3000]',
            'messages' => [
                'maxSize' => 'La imagen debe ser menor a 100 kilobytes',
                'maxDims' => 'Las dimensiones máximas de imagen son de 3000px por 3000px',
                'mimeIn'  => 'Tipo de archivo inválido, selecciona image/png,image/jpeg,image/jpg',
            ],
        ],
        'video' => [
            'rules'    => 'maxSize[10,mb]|mimeIn[video/mp4]',
            'messages' => [
                'maxSize' => ' El video debe ser menor a 100 megabytes',
                'mimeIn'  => 'Tipo de archivo inválido, selecciona video/mp4',
            ],
        ],
        'datasheet' => [
            'rules'    => 'maxSize[2,mb]|minSize[10,kb]|mimeIn[application/pdf]',
            'messages' => [
                'maxSize' => 'El archivo debe ser menor a 2 megabytes',
                'minSize' => 'El archivo debe ser mayor a 10 kilobytes',
                'mimeIn'  => 'Tipo de archivo inválido, selecciona application/pdf',
            ],
        ],
    ];

    public function __construct()
    {
        $this->filepondConfig = [
            // this parameter is going to be passed through a general Builder, that combines filepond and validation server
            'baseUrl'   => '/admin/testFiles',
            'image'     => ClientValidationConfig::builder('image')->maxFiles(3)->maxSize(200, 'KB')->allowMultipleFiles()->isImage()->maxDims(3000, 3000)->build()->getConfig(),
            'video'     => ClientValidationConfig::builder('video')->maxFiles(2)->maxSize(10, 'MB')->allowMultipleFiles()->isVideo()->build()->getConfig(),
            'datasheet' => ClientValidationConfig::builder('datasheet')->maxFiles(2)->minSize(10, 'KB')->maxSize(2, 'MB')->allowMultipleFiles()->isPDF()->build()->getConfig(),
        ];
    }

    /**
     * View for visualize all register of a file test
     *
     * This method return the view with the tests table
     *
     * @return string
     */
    public function viewTestFiles()
    {
        return view('admin/test/testFiles', ['tests' => [
            [
                'testId'   => 1,
                'testName' => 'test 1',
            ],
        ]]);
    }

    /**
     * View for create a file test register
     *
     * @return string
     */
    public function viewTestFilesCreate()
    {
        return view('admin/test/testFilesCreate', ['filepondConfig' => $this->filepondConfig]);
    }

    /**
     * Creates a register of a file test
     */
    public function createTestFiles()
    {
        echo 'creando test';
    }

    /**
     * View for edit a file test register
     *
     * @param string $id the id of the file test register
     */
    public function viewTestFilesEdit($id)
    {
        return view('admin/test/testFilesEdit', [
            'name'           => "file test name on id: {$id}",
            'filepondConfig' => $this->filepondConfig,
        ]);
    }

    /**
     * Update a register of a file test
     *
     * @param string $testId the id of the file test register
     */
    public function updateTestFiles($testId)
    {
        echo 'actualizando test';
    }

    /**
     * Delete a file test register
     */
    public function deleteTestFiles()
    {
        echo 'borrando test';
    }
}
