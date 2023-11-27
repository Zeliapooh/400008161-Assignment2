<?php

namespace COMP3385;

abstract class AbstractSecurity {

    protected $session; 
    public function __construct() {
       // $this->session = $session;

    }

    abstract public function hashPassword($password) ;

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    abstract public function generateCSRFToken() ;

    public function validateCSRFToken($sessionToken, $token) {
        // Validate CSRF token
        if($sessionToken!= null && hash_equals($sessionToken, $token)) {
            // Valid token
            return true;
        }
        // Invalid token
        return false;
    }

}
