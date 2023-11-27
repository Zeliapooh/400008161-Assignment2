<?php
namespace COMP3385;

abstract class AbstractValidator {
    protected $errors = [];

    public function getErrors() {
        return $this->errors;
    }

    protected function validateRequired($field, $value) {
        if (empty($value)) {
            $this->addError($field, 'The field '. $field.' is required.');
        }
    }

    public function validateLength($field, $value, $length)  {
        if(strlen($value) < $length){
            $this->addError($field, 'The field '. $field.' must be more than '.$length.' .');
        }
    }

    public function validateEmailValid($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, 'Invalid email format.');
        }
    }

    public function addError($field, $message) {
        $this->errors[$field][] = $message;
    }
    public function getIndividualErrors($name) {
        if ($name === null) {
            return $this->errors;
        }

        return $this->errors[$name] ?? [];
    }

    abstract public function validate($data);
}
