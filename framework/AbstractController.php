<?php

namespace COMP3385;

abstract class AbstractController{
    protected $model;
    protected $view;

    public function __construct(){

    }

    public function setModel($model){
        $this->model = $model;
    }
    public function getModel(){
        return $this->model;
    }

    public function setView($view){
        $this->view = $view;
    }

}