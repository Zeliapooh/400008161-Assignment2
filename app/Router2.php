<?php

namespace COMP3385;

class Router2 extends AbstractRouter2
{
    protected $routes = [];
    protected $response;

    public function __construct()
    {
        $this->response = new RouterResponse();
    }

    public function addRoutes(array $routes) {
        $this->routes = $routes;
    }

    public function addIndividualRoutes($route, $function) {
        $this->routes[$route] = $function;
    }

    public function addRoute($pattern, $callback) {
        $this->routes[$pattern] = $callback;
        }
    public function execute($url)
    {
        if (array_key_exists($url, $this->routes)) {
            $routeInfo = $this->routes[$url];
            list($controllerName, $action) = explode('@', $routeInfo);
            $controllerFile = APP_DIR . '\\controllers\\' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require $controllerFile;
                $newName = "COMP3385\\".$controllerName;
                $controller = new $newName();
                if (method_exists($controller, $controller->$action($this->response))) {
                    $controller->$action($this->response);
                    return;
                }
            } else {
                $this->response->error(404, $controllerFile.' File not found: The requested file could not be located.');
            }

        }
        else{
            $this->response->error(404, $url.' Route not found: The requested route could not be located.');

        }

    }

}