<?php 

namespace App\Models;

class ConfigFile {
    public $filepondConfig = [];
    public $validationRules = "";
    public $validationRulesMessages = [];

    public function __construct()
    {
        return new ConfigFileBuilder();
    }
    public function getFilepondConfig() {
        $this->builder->
    }
}