<?php
namespace COMP3385;

class Authenticator extends AbstractAuthenticator{

    public function login($email, $password) {
   
        //$user = $this->model->check_email_exists($email);
        $user = $this->model->fetch('users', 'email', $email);


        if ($user && $this->security->verifyPassword($password, $user['password'])) {
            // Password is correct
            $this->session->set('username',  $user['username']);
            $this->session->set('email', $user['email']);
            $this->session->set('role', $user['role']);
            return true;
        }

        // Password incorrect or user not found
        return false;

      
    }
}