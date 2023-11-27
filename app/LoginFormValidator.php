<?php
namespace COMP3385;

class LoginFormValidator extends AbstractValidator { 
    public function validate($data) {
        $this->validateEmail('email', $data['email']);
        $this->validatePassword('password', $data['password']);

    }
    public function validateEmail($field, $email) {
        $this->validateRequired($field, $email);
        $this->validateEmailValid($field, $email);
    }

    public function validatePassword($field, $password) {
        $this->validateRequired($field, $password);

    }
    
    // Other validation methods like validatePassword, validateUsername, etc.
}
