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
    }

    public function isLoggedIn() {
        return  $this->session->get('username'); // Check if user is logged in
    }
}
