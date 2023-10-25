<?php

namespace App\Validation;

use CodeIgniter\Validation\Exceptions\ValidationException;
use App\Exceptions\FileValidationException;
use InvalidArgumentException;

class ChunkFilesValidation
{
    protected $beforeUploadRules = [];
    protected $afterUploadRules = [];
    protected $customErrors = [];
    
    public function runBeforeUpload($data) {
        $rules = $this->beforeUploadRules;
        return $this->runRules($data, $rules);
    }
    public function runAfterUpload($data) {
        $rules = $this->afterUploadRules;
        return $this->runRules($data, $rules);
    }
    public function setRules(array $rules, array $messages) {
        $this->customErrors = $messages;

        if(!isset($rules["beforeUpload"]) || !isset($rules["afterUpload"])) {
            throw new InvalidArgumentException("Set beforeUpload and afterUpload rules");
        }

        $beforeUploadRules = explode("|", $rules["beforeUpload"]);
        $afterUploadRules = explode("|", $rules["afterUpload"]);

        $this->beforeUploadRules = $beforeUploadRules;
        $this->afterUploadRules = $afterUploadRules;   
    }
    protected function runRules($data, $rules) {
        if(empty($rules)) return false;
        return $this->processRule($rules, $data);
    }
    protected function processRule(array $rules, $data) {
        foreach($rules as $rule) {
            $param = false;
            $passed = false;
            if(preg_match('/(.*?)\[(.*)\]/', $rule, $match)) {
                $rule = $match[1];
                $param = $match[2];
            }

            $instance = new ChunkFileRules();

            if(!method_exists($instance, $rule)) {
                throw ValidationException::forRuleNotFound($rule);
            }

            $passed = $instance->{$rule}($data, $param);

            if($passed === false) {
                $error = $this->customErrors[$rule] ?? "validation failed on rule $rule";
                throw new FileValidationException($error);
            }
        }
        return true;
    }
}
