<?php

//The response returns the page depending on the type of page or view the user might need to be authenticated
namespace COMP3385;

abstract class AbstractRouterResponse{

     abstract public function renderView($view, $data = []) ;


   abstract public function redirect($url);

   
    public function error($code, $message = '') {
        http_response_code($code);
        echo $message;
    }
    

}