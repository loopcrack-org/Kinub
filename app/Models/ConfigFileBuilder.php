<?php 

namespace App\Models;

class ConfigFileBuilder {
    private ConfigFile $config;

    public function __construct()
    {
        $this->config = new ConfigFile();
    }
    public function maxSize(int $size): ConfigFileBuilder {
        $this->config->validationRules .= "max_size[$size]|";


        return $this;
    }
    public function isImage(): ConfigFileBuilder {
        return $this;
    }
    public function maxDims(int $width, int $height): ConfigFileBuilder {
        return $this;
    }
    public function mimeIn(array $mime_types): ConfigFileBuilder {
        return $this;
    }
    public function extIn(array $extensions): ConfigFileBuilder {
        return $this;
    }
    public function maxFiles(int $files): ConfigFileBuilder {
        return $this;
    }
    public function minFiles(int $files): ConfigFileBuilder {
        return $this;
    }
    public function name(string $name): ConfigFileBuilder {
        return $this;
    }
    public function chunkSize(int $size): ConfigFileBuilder {
        return $this;
    }
    public function imagePreviewHeight(int $pixels): ConfigFileBuilder {
        return $this;
    }
    public function imageCropAspectRatio(string $ratio): ConfigFileBuilder {
        return $this;
    }
    public function imageResizeTargetWidth(int $resize): ConfigFileBuilder {
        return $this;
    }
    public function imageResizeTargetHeight(int $resize): ConfigFileBuilder {
        return $this;
    }
    public function build() {
        return $this->config;
    }
}