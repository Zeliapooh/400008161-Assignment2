<?php
namespace COMP3385;

class RegistrationFormValidator extends AbstractValidator { 
    public function validate($data) {
        $this->validateUsername('username', $data['username']);
        $this->validateEmail('email', $data['email']);
        $this->validatePassword('password', $data['password']);

    }
    public function validateEmail($field, $email) {
        $this->validateRequired($field, $email);
        $this->validateEmailValid($field, $email);

        
    }

    public function validatePassword($field, $password) {
        $this->validateRequired($field, $password);
        $this->validateLength($field, $password, 10);
        
        $hasUppercase = preg_match('@[A-Z]@', $password);
        $hasLowercase = preg_match('@[a-z]@', $password);
        $hasDigit = preg_match('@[0-9]@', $password);

        if (!$hasUppercase || !$hasLowercase || !$hasDigit ) {
            $this->addError($field, 'Passwords must contain at least one upper case character, at least one digit');
        }
    }
    
    public function validateUsername($field, $username) {
        $this->validateRequired($field, $username);
 
    }
}
