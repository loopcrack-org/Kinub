<?php

namespace App\Classes;

class FileValidationConfig
{
    private array $config;
    private String $baseUrl;

    public function __construct(array $config = [], String $baseUrl = "")
    {
        $this->config = $config;
        $this->baseUrl = $baseUrl;
    }


    public function getClientConfig()
    {
        $configFilepond['baseUrl'] = $this->baseUrl;
        foreach($this->config as $inputName => $value) {
            $configFilepond[$inputName] = $value[0]->getConfig();
        }

        return $configFilepond;
    }

    public function setDataInClientConfig(array $data)
    {
        foreach ($this->config as $inputName => $clientConfig) {
            $clientConfig[0]->setFiles($data[$inputName]);
            $clientConfig[0]->setDeletedFiles($data["delete-$inputName"] ?? []);
        }
    }

    public function filterNewFilesInInputsFile(array $data): array
    {
        $files = [];
        foreach ($this->config as $inputName => $clientConfig) {
            $files[$inputName] = $clientConfig[0]->filterNewFilesInInput($data[$inputName]) ?? [];
        }

        return $files;
    }

    public function getKeysFolderToDelete(array $data): array
    {
        $deletFiles = [];
        foreach ($this->config as $inputName => $value) {
            $deletFiles[$inputName] = $data["delete-$inputName"] ?? [];
        }

        return $deletFiles;
    }

    public function getFileValidationRulesByInput(String $inputName)
    {
        return $this->config[$inputName][1]->getFileValidationRules();
    }

    public function getCollectionFileValidationRules()
    {
        $validationsRules = [];

        foreach ($this->config as $key => $value) {
            $validationsRules['rules'][$key] = $value[1]->getCollectionFileValidationRules()['rules'];
            $validationsRules['messages'][$key] = $value[1]->getCollectionFileValidationRules()['messages'];
        }

        return $validationsRules;
    }
}