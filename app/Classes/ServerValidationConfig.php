<?php

namespace App\Classes;

class ServerValidationConfig
{
    private $fileValidationRules;
    private $collectionFileValidationRules;

    public function __construct(ServerValidationConfigBuilder $serverConfigBuilder)
    {
        $this->fileValidationRules = $serverConfigBuilder->fileValidationRules();
        $this->collectionFileValidationRules = $serverConfigBuilder->collectionFileValidationRules();
    }

    public static function builder()
    {
        return new ServerValidationConfigBuilder();
    }

    public function getFileValidationRules(): array
    {
        return $this->fileValidationRules;
    }

    public function getCollectionFileValidationRules(): array
    {
        return $this->collectionFileValidationRules;
    }
}