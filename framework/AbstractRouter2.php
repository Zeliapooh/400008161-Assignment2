<?php


namespace COMP3385;

abstract class AbstractRouter2{
    // protected $routes = [];
    // public function addRoute($url, $callback) {
    //     $this->routes[$url] = $callback;
    // }
    // public function addRoute($url, $controller, $action) {
    //     $this->routes[$url] = ['controller' => $controller, 'action' => $action];
    // }

    abstract public function execute($url);
}
