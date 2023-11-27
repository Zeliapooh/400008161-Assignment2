<?php
namespace COMP3385;

class RouterResponse extends AbstractRouterResponse {  
    public function __construct() {}

    public function renderView($view, $data = []) {
        extract($data);
        include APP_DIR.'\views\\' . $view . '.php';
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    
}