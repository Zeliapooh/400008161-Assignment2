<?php

namespace COMP3385;

 class Security extends AbstractSecurity{

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

   
    public function generateCSRFToken() {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public function checkPermission($role, $session){
        if($session->get('role')){
            if($session->get('role') == $role){
                return true;
            }
        }

    }

}
