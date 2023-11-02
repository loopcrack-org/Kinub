<?php

namespace App\Classes;

class FilepondConfig
{
    private array $config;

    public function __construct(FilepondConfigBuilder $filepondConfigBuilder)
    {
        $this->config = $filepondConfigBuilder->filepondConfig();
    }

    public static function builder(String $inputName)
    {
        return new FilepondConfigBuilder($inputName);
    }

    public function setFiles(array $files)
    {
        $this->config['files'] = $files;
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
