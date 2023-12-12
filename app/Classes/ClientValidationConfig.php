<?php

namespace App\Classes;

class ClientValidationConfig
{
    private array $config;

    public function __construct(ClientValidationConfigBuilder $clientConfigBuilder)
    {
        $this->config = $clientConfigBuilder->config();
    }

    public static function builder(string $inputName)
    {
        return new ClientValidationConfigBuilder($inputName);
    }

    public function setFiles(array $files = [])
    {
        if (! empty($files) && $files[0] !== '') {
            $this->config['files'] = array_map(static function ($folderFile) {
                $sourceType = file_exists(FILES_UPLOAD_DIRECTORY . $folderFile) ? 'local' : 'limbo';

                return [
                    'source'  => $folderFile,
                    'options' => [
                        'type' => $sourceType,
                    ],
                ];
            }, $files);
        }
    }

    public function filterNewFilesInInput(array $files)
    {
        $newFiles = [];

        foreach ($files as $folderFile) {
            if (! file_exists(FILES_UPLOAD_DIRECTORY . $folderFile)) {
                $newFiles[] = $folderFile;
            }
        }

        return $newFiles;
    }

    public function setDeletedFiles(array $files)
    {
        if (! empty($files)) {
            $this->config['deleteFiles'] = $files;
        }
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
