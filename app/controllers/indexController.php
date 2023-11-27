<?php
namespace COMP3385;

class indexController
{
  public function __construct()
  {  

  }

  public function index($response){
    
    $response->renderView('LoginView');
  }


}

?>