<?php

namespace COMP3385;

abstract class AbstractFormGenerator {
    protected $formData = [];
    protected $errors = [];

    public function __construct($formData = []) {
        $this->formData = $formData; 
    }

    public function openForm($action = '', $method = 'post', $attributes = []) {
        $attributes['action'] = $action;
        $attributes['method'] = $method;
        $attributes = $this->buildAttributes($attributes);

        return "<form {$attributes}>";
    }

    public function closeForm() {
        return '</form>';
    }

    public function generateInput($type, $name,$attributes) {
        $value = isset($_POST[$name]) ? $_POST[$name] : '';
        $error = isset($this->errors[$name]) ? implode(', ', $this->errors[$name]) : '';
        $input = "<label for='{$name}'>{$name}:</label>";
        $input .= "<input type='{$type}' name='{$name}' id='{$name}' ";

        foreach ($attributes as $key => $value) {
            $input .= " {$key}='{$value}'";
        }

        $input .= ' >';
        $input .= "<span style='color: red;' class = 'errorSpan'>{$error}</span><br>";

 
        return $input;
    } 

    public function generateHiddenInput($type, $name,$attributes) {
        $value = isset($_POST[$name]) ? $_POST[$name] : '';
        $error = isset($this->errors[$name]) ? implode(', ', $this->errors[$name]) : '';
        $input = "<input type='{$type}' name='{$name}' id='{$name}' ";

        foreach ($attributes as $key => $value) {
            $input .= " {$key}='{$value}'";
        }

        $input .= ' >';
        $input .= "<span style='color: red;' class = 'errorSpan'>{$error}</span><br>";


        return $input;
    } 

    public function generateSelect($name, $options, $selectedValue, $attributes) {
        $attributes['name'] = $name;
        $attributes = $this->buildAttributes($attributes);
        $select = "<label for='{$name}'>{$name}:</label>";

        $select .= "<select {$attributes}>";
        foreach ($options as $value => $label) {
            $selected = ($selectedValue == $value) ? 'selected' : '';
            $select .= "<option value='{$label}' {$selected}>{$label}</option>";
        }
        $select .= "</select><br>";

        return $select;
    }

    public function generateButton( $value, $attributes) {
        $attributesString = $this->buildAttributes($attributes);
        return "<button  $attributesString>$value</button>";
    }



    protected function buildAttributes($attributes) {
        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= " {$key}='{$value}'";
        }

        return $attributeString;
    }

    public function addError($errors) {
        $this->errors = $errors;
    }

    public function getErrors() {
        return $this->errors;
    }

    
    public function getIndividualErrors($name) {
        if ($name === null) {
            return $this->errors;
        }

        return $this->errors[$name] ?? [];
    }

    abstract public function generateForm();

}
