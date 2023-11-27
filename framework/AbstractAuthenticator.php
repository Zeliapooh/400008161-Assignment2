<?php

namespace COMP3385;

abstract class AbstractAuthenticator {
    protected $security;
    protected $model; 
    protected $session;

    public function __construct($security, $model, $session) {
        $this->security = $security;
        $this->model = $model;
        $this->session = $session;
    }

    abstract public function login($username, $password);

    public function logout() {
        $this->session->destroy();
        $this->session->deleteAll();
       // unset($_SESSION['user']); // Unset user session on logout
    }

    public function isLoggedIn() {
       // $this->session->get('username');
        return  $this->session->get('username'); // Check if user is logged in
    }
}
