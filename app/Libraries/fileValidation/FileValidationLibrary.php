<?php

namespace App\Libraries\fileValidation;

use CodeIgniter\Validation\Exceptions\ValidationException;
use App\Exceptions\FileValidationException;
use InvalidArgumentException;

class FileValidationLibrary
{
    protected $rules = [];
    protected $customErrors = [];

    public function __construct(string $rules, array $messages = [])
    {
        $this->customErrors = $messages;
        if(!isset($rules) || empty($rules)) {
            throw new InvalidArgumentException("Invalid argument. Not rules founded");
        }
        $this->rules = explode("|", trim($rules, "|"));
    }
    public function run($data)
    {
        return $this->processRule($this->rules, $data);
    }
    protected function processRule(array $rules, $data)
    {
        foreach($rules as $rule) {
            $param = false;
            $passed = false;
            if(preg_match('/(.*?)\[(.*)\]/', $rule, $match)) {
                $rule = $match[1];
                $param = $match[2];
            }

            $instance = new CustomFileRules();

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
